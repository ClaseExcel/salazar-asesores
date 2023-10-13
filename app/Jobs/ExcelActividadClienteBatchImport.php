<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\ActividadCliente;
use App\Models\ReporteActividad;
use Illuminate\Support\Facades\Session;

class ExcelActividadClienteBatchImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        set_time_limit(300);
        ini_set('memory_limit', '2048M');
        $uploadedFile = new UploadedFile(
            $this->filePath,
            basename($this->filePath),
            mime_content_type($this->filePath),
            null,
            true
        );

        $spreadsheet = IOFactory::load($uploadedFile);
        // toma la primera hoja del excel
        $sheetIndex = 0; // Índice de la hoja que deseas cargar 
        $sheet = $spreadsheet->getSheet($sheetIndex);

  
        
        // Obtener los títulos de la primera fila
        $firstRow = $sheet->getRowIterator(1)->current();
        $columnTitles = [];
        foreach ($firstRow->getCellIterator() as $cell) {
            $columnTitles[] = $cell->getValue();
        }

        
    
        // Definir los títulos válidos
        $validColumns = ['Nombre', 'Tipo actividad', 'Progreso', 'Prioridad alta', 'Fecha vencimiento', 'Periodicidad', 'Cantidad recordatorios', 'Cantidad días entre recordatorios', 'Observación', 'Responsable Actividad', 'Empresa','Responsable','Cliente','Estado'];
    
        // Verificar si los títulos coinciden
        $invalidColumns = array_diff($validColumns, $columnTitles);
        if (!empty($invalidColumns)) {
            $errorMessage = "El archivo Excel no tiene los títulos esperados por favor verifica con la plantilla ";
            Session::flash('message2',$errorMessage);
            Session::flash('color', 'danger');
            return;
        }
        
        // Mapeo de nombres de columna del Excel a los nombres del modelo
        $columnMapping = [
            'A' => 'nombre',
            'B' => 'actividad_id',
            'C' => 'progreso',
            'D' => 'prioridad',
            'E' => 'fecha_vencimiento',
            'F' => 'periodicidad',
            'G' => 'recordatorio',
            'H' => 'recordatorio_distancia',
            'I' => 'nota',
            'J' => 'responsable_id',
            'K' => 'empresa_asociada_id',
            'L' => 'usuario_id',
            'M' => 'cliente_id',
            'N' => 'estado_actividad_id',
        ];

        $data = [];
        $skipFirstRow = true;
        foreach ($sheet->getRowIterator() as $row) {

            if ($skipFirstRow) {
                $skipFirstRow = false;
                continue; // Saltar la primera iteración
            }

            $rowData = [];
            $hasData = false; // Variable para rastrear si la fila contiene dat
            foreach ($row->getCellIterator() as $cell) {
                $columnName = $cell->getColumn();
                if (isset($columnMapping[$columnName]) && $columnName <= 'N') {
                    $columnNameModel = $columnMapping[$columnName];
                    $value = $cell->getValue();

                    // Verifica si el valor contiene un guion "-"
                    if (strpos($value, '-') !== false) {
                        // Divide el valor por el guion "-" y toma la primera parte
                        $value = explode('-', $value)[0];
                    }
                    // Verifica si la columna actual es E y luego convierte la fecha numérica
                    if ($columnName === 'E') {
                        // Convierte el valor numérico a una fecha en formato "Y-m-d"
                        $fecha = date('Y-m-d', strtotime('1899-12-30 +' . $value . ' days'));
                        $rowData[$columnNameModel] = $fecha;
                    } else {
                        $rowData[$columnNameModel] = $value;
                    }
                      // Verifica si la celda contiene datos
                    if (!empty($value)) {
                        $hasData = true;
                    }
                }
            }
              // Si la fila contiene datos, agrégala a $data
            if ($hasData) {
                $data[] = $rowData;
            }
        }

        // Itera a través de tus datos
        foreach ($data as $datos) {
            $camposNoVacios = array_filter($datos, function ($campo) {
                return !empty($campo);
            });

            // Verifica si al menos un campo no está vacío
            if (!empty($camposNoVacios)) {
                // Crea un nuevo registro en ReporteActividad
                if (isset($datos['estado_actividad_id'])) {
                    $estadoActividadId = $datos['estado_actividad_id'];
                } else {
                    // Asigna un valor por defecto o realiza alguna lógica para determinar el valor
                    $estadoActividadId = 1; // Ejemplo de valor por defecto
                }

                $reporteActividad = ReporteActividad::create([
                    'estado_actividad_id' => $estadoActividadId,
                ]);

                // Verifica si actividad_id está presente en los datos
                if (isset($datos['actividad_id'])) {
                    $actividadId = $datos['actividad_id'];
                } else {
                    // Asigna un valor por defecto o realiza alguna lógica para determinar el valor
                    $actividadId = 1; // Ejemplo de valor por defecto
                }

                // Asegúrate de que $record sea un array asociativo
                $record = [
                    'nombre' => $datos['nombre'],
                    'actividad_id' => $actividadId,
                    'progreso' => $datos['progreso'],
                    'prioridad' => $datos['prioridad'],
                    'fecha_vencimiento' => $datos['fecha_vencimiento'],
                    'periodicidad' => $datos['periodicidad'],
                    'recordatorio' => $datos['recordatorio'],
                    'recordatorio_distancia' => $datos['recordatorio_distancia'],
                    'nota' => $datos['nota'],
                    'responsable_id' => $datos['responsable_id'],
                    'cliente_id' => $datos['cliente_id'],
                    'usuario_id' => $datos['usuario_id'],
                    'reporte_actividad_id' => $reporteActividad->id,
                    'empresa_asociada_id' => $datos['empresa_asociada_id'],
                ];

                // Inserta el registro en la tabla ActividadCliente
                ActividadCliente::create($record);
            }
        }



        




        // set_time_limit(300);

        // $data = array_chunk($data,200);
        // ini_set('memory_limit', '2048M');
        // foreach ($data as $chunk) {
        //     $insertData = [];
        //     foreach ($chunk as $record) {
        //         $insertData[] = $record;
        //     }
        //     ActividadCliente::insert($insertData);
        // }
        // Si la importación se realizó con éxito
        Session::flash('message2', 'Importación exitosa');
        Session::flash('color', 'success');
    }
}
