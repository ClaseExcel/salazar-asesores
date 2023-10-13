<?php

namespace App\Exports;

// use Illuminate\Contracts\View\View;
// use App\Models\Actividad;
// use App\Models\Responsable;
// use App\Models\Empresa;
// use App\Models\User;
// use App\Models\ReporteActividad;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
//

// use Maatwebsite\Excel\Concerns\WithHeadings;

// use Maatwebsite\Excel\Concerns\WithMapping;
// use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Events\AfterSheet;
// use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// //
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\FromArray;

class ActividadClienteExport implements FromArray
{
    protected $datosParaExcel;

    public function __construct(array $datosParaExcel)
    {
        $this->datosParaExcel = $datosParaExcel;
    }

    public function array(): array
    {
        // Ruta del archivo Excel existente
        $rutaExcelExistente = public_path('data/ActividadCliente/MasivoActividades.xlsx');

        // Carga el archivo Excel existente
        $spreadsheet = IOFactory::load($rutaExcelExistente);

        // Obtiene la hoja "listas" del Excel
        $hojaListas = $spreadsheet->getSheetByName('listas');

        // Llena la hoja "listas" con los nuevos datos
        $this->llenarHojaConDatos($hojaListas, $this->datosParaExcel);

        // Guarda el Excel modificado
        $writer = new Xlsx($spreadsheet);
        $writer->save($rutaExcelExistente);

        // Devuelve los datos como un array, pero no es necesario usarlos aquí.
        return [];
    }

    public function llenarHojaConDatos($hoja, $datos)
    {
         // Borra los valores existentes en todas las celdas de la hoja
    $hoja->removeColumn('A');
    $hoja->fromArray([], null, 'A1');

    $rowIndex = 1;
    foreach ($datos as $clave => $valores) {
        // Escribe la clave en la primera columna
        $hoja->setCellValue('A' . $rowIndex, $clave);

        // Escribe los valores en las siguientes columnas
        $columnIndex = 2;
        foreach ($valores as $valor) {
            $hoja->setCellValueByColumnAndRow($columnIndex, $rowIndex, $valor);
            $columnIndex++;
        }

        $rowIndex++;
    }
        
    
    }
}


// class ActividadClienteExport implements  WithHeadings, WithMapping, WithEvents
// {
//     protected $data;

//     public function __construct(array $data)
//     {
//         $this->data = $data;
//     }

//     public function headings(): array
//     {
//         // Define los encabezados de las columnas aquí
//         return [
//             'Actividades',
//             'Responsables',
//             'Empresas',
//             'Users',
//             'ReporteActividades',
//             // Agrega más encabezados según sea necesario
//         ];
//     }

//     public function array(): array
//     {
//         // Devuelve los datos en forma de arreglo
//         return $this->data;
//     }

//     public function sheetName(): string
//     {
//         // Define el nombre de la hoja en el archivo Excel
//         return 'Datos';
//     }

//     public function map($row): array
//     {
//         return [
//             $row[0], // Actividades
//             $row[1], // Responsables
//             $row[2], // Empresas
//             $row[3], // Users
//             $row[4], // ReporteActividades
//         ];
//     }

//     public function registerEvents(): array
// {
//     return [
//         AfterSheet::class => function (AfterSheet $event) {
//             // Definir validaciones de lista desplegable para cada columna

//             $sheet = $event->sheet;
//             $validator = $sheet->getCell('A2')->getDataValidation();

//             // Ejemplo: Actividades
//             $actividadesOptions = 'Sheet1!$A$2:$A$100'; // Ajusta el rango según tu cantidad de datos
            
//             $validator->setType(DataValidation::TYPE_LIST);
//             $validator->setErrorStyle(DataValidation::STYLE_STOP);
//             $validator->setShowDropDown(true);
//             $validator->setFormula1($actividadesOptions);

//             // Repite este proceso para las otras columnas (Responsables, Empresas, Users, ReporteActividades)
//         },
//     ];
// }
    
//     // public function view(): View
//     // {
//     //     $actividades = Actividad::all();
//     //     $actividadesData = $actividades->pluck('nombre', 'id')->toArray();
//     //     $Responsables = Responsable::all();
//     //     $Empresas = Empresa::all();
//     //     $Users = User::all();
//     //     $ReporteActividades = ReporteActividad::all();
//     //     return view('admin.actividadcliente.masivoactividades', [
//     //         'actividades' => $actividadesData,
//     //         'Responsables' => $Responsables,
//     //         'Empresas'  => $Empresas,
//     //         'Users'  => $Users,
//     //         'ReporteActividades' => $ReporteActividades,
//     //     ]);
//     // }
// }
