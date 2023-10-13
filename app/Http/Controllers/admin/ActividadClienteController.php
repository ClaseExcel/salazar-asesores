<?php

namespace App\Http\Controllers\admin;

use App\Exports\ActividadClienteExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActividadClienteRequest;
use App\Http\Requests\UpdateActividadClienteRequest;
use App\Jobs\ExcelActividadClienteBatchImport;
use App\Mail\NotificacionActividades;
use App\Models\Actividad;
use App\Models\ActividadCliente;
use App\Models\ReporteActividad;
use App\Models\EstadoActividad;
use App\Models\Empresa;
use App\Models\EmpleadoCliente;
use App\Models\Responsable;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ActividadClienteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $this->authorize('viewAny',Actividad::class);

        $user = Auth::user();

        if($user->rol_id == 1 || $user->rol_id == 2 || $user->rol_id == 8) {
            $actividad_cliente = ActividadCliente::orderBy('cliente_id', 'desc')->paginate(10);
        } else {
            $actividad_cliente = ActividadCliente::where('usuario_id', $user->id)->orderBy('cliente_id', 'desc')->paginate(10);
        }

        return view('admin.actividadcliente.index', compact('actividad_cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Actividad::class);

        $actividad = Actividad::pluck('nombre', 'id');
        $responsable = Responsable::pluck('nombre', 'id');
        $clientes = Empresa::whereNotIn('id', [1])->select('razon_social', 'id')->get();
        $usuario = User::select('id', 'nombres', 'apellidos')->whereNotIn('rol_id', [6,7])->get();
        return view('admin.actividadcliente.create', compact('actividad','responsable','clientes','usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateActividadClienteRequest $request)
    {
        $reporteActividad = ReporteActividad::create([
            'estado_actividad_id' => 1,
        ]);

        $empresa = null;
        
        if($request['empresa_asociada_id']) {
            $empresa = $request['empresa_asociada_id'];
        } else if ($request['cliente_id'] == 1 && $request['empresa_asociada_id'] == null) {
            $empresa = 1;
        }

        // *** Crea la actividad
        $actividadCliente = ActividadCliente::create([
                'nombre' => $request['nombre'],
                'actividad_id' => $request['actividad_id'],
                'progreso' => $request['progreso'],
                'prioridad' => $request['prioridad'],
                'fecha_vencimiento' => $request['fecha_vencimiento'],
                'periodicidad' => $request['periodicidad'],
                'recordatorio' => $request['recordatorio'],
                'recordatorio_distancia' => $request['recordatorio_distancia'],
                'nota' => $request['nota'],
                'responsable_id' => $request['responsable_id'],
                'cliente_id' => $request['cliente_id'],
                'usuario_id' => $request['usuario_id'],
                'reporte_actividad_id' => $reporteActividad->id,
                'empresa_asociada_id' => $empresa,
    ]);

      

        // *** Ruta base para los archivos
        $fileBasePath = storage_path('app/public/data/actividadcliente');
        // *** Define inputs y columnas
        $documents = [
            'documento_1' => 'file_documento_1',
            'documento_2' => 'file_documento_2',
            'documento_3' => 'file_documento_3',
            'documento_4' => 'file_documento_4',
            'documento_5' => 'file_documento_5',
        ];
        // *** Valida documentos
        foreach ($documents as $documentInput => $documentPath) {
            $this->load_file_create($request, $actividadCliente->id, $documentInput, $documentPath, $fileBasePath);
        }
        // *** Actualiza columnas de documentos
        $columnsToUpdate = ['file_documento_1','file_documento_2','file_documento_3','file_documento_4','file_documento_5'];
        ActividadCliente::where('id', $actividadCliente->id)->update($request->only($columnsToUpdate));
        return redirect()->route('admin.actividad_cliente.index')->with('message', 'La actividad se ha creado correctamente.')->with('color', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ActividadCliente $actividadCliente)
    {
        $this->authorize('view', Actividad::class);

        $reporteActividad = ReporteActividad::where('id', $actividadCliente->reporte_actividad_id)->first();

        return view('admin.actividadcliente.show', compact('actividadCliente', 'reporteActividad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Actividad::class);

        $actividad = Actividad::pluck('nombre', 'id');
        $responsable = Responsable::pluck('nombre', 'id');
        $empresa = Empresa::pluck('razon_social', 'id');
        $usuario = User::select('id', 'nombres', 'apellidos')->whereNotIn('rol_id', [6,7])->get();
        $actividad_cliente = ActividadCliente::find($id);
        $clientes = Empresa::whereNotIn('id', [1])->where('id', $actividad_cliente->empresa_asociada_id)->select('razon_social', 'id')->get();

        return view('admin.actividadcliente.edit', compact('actividad','responsable','empresa','usuario', 'clientes','actividad_cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActividadCliente $actividad_cliente)
    {
        // *** Ruta base para los archivos
        $fileBasePath = storage_path('app/public/data/actividadcliente');
        // *** Define inputs y columnas
        $documents = [
            'documento_1' => 'file_documento_1',
            'documento_2' => 'file_documento_2',
            'documento_3' => 'file_documento_3',
            'documento_4' => 'file_documento_4',
            'documento_5' => 'file_documento_5',
        ];
        // *** Valida documentos
        foreach ($documents as $documentInput => $documentPath) {
            $name = $actividad_cliente->$documentPath;
            $name = $this->load_file_update($request, $actividad_cliente->id, $documentInput, $documentPath, $fileBasePath, $name);
            $request->merge([$documentPath => $name]);
        }

        $actividad_cliente->update($request->all());

        return redirect()->route('admin.actividad_cliente.index')->with('message', 'Se ha actualizado exitosamente la actividad.')->with('color', 'success');
    
    }

    public function reporteIndex($id) {

        $this->authorize('view', Actividad::class);
        
        $usuario = User::select('id', 'nombres', 'apellidos')->whereNotIn('rol_id', [6,7])->get();
        $actividad_cliente = ActividadCliente::find($id);
        $cliente = Empresa::all();

        $reporteActividad = ReporteActividad::where('id', $actividad_cliente->reporte_actividad_id)->first();

        if (in_array(Auth::user()->rol_id, [1, 2, 8]) && $actividad_cliente->usuario_id == Auth::user()->id) {
            $estado_actividad = EstadoActividad::whereNotIn('id', [1,6,5])->get();
        } else if(in_array(Auth::user()->rol_id, [1, 2, 8]) ){
            $estado_actividad = EstadoActividad::whereNotIn('id', [1,2,3,6,7])->get();
        } else {
            $estado_actividad = EstadoActividad::whereNotIn('id', [1,5,4,6])->get();
        }

        return view('admin.actividadcliente.edit-reporte', compact('usuario','cliente', 'actividad_cliente', 'estado_actividad', 'reporteActividad'));
    }

    public function reporteEdit(Request $request, $id) {


        $actividad_cliente = ActividadCliente::find($id);

        $reporteActividad = ReporteActividad::where('id', $actividad_cliente->reporte_actividad_id)->first();

        $urlPathDocument = null;

        if($reporteActividad->documento != null && $request->file('documento')) {
            $foldername = basename(dirname($reporteActividad->documento));

            $archivo = $request->file('documento');

            if(File::exists($reporteActividad->documento)) {
                File::delete($reporteActividad->documento);
            }

            $documento = $archivo->getClientOriginalName();
            $urlPathDocument = 'storage/reporte_documento/' . $foldername . '/' . $archivo->getClientOriginalName();

            Storage::disk('reporte_documento')->put($foldername . '/' . $documento, File::get($archivo));
        } else {
            if($request->file('documento')){
                $archivo = $request->file('documento');
                $foldername = uniqid();
    
                $documento = $archivo->getClientOriginalName();
                $urlPathDocument = 'storage/reporte_documento/' . $foldername . '/' . $archivo->getClientOriginalName();
    
                Storage::disk('reporte_documento')->put($foldername . '/' . $documento, File::get($archivo));
            }
        }
        

        if($request['estado_actividad_id'] == 2) {
            $actividad_cliente->update([
                'progreso' => '0'
            ]);

            $reporteActividad->update([
                'fecha_inicio' => Carbon::now()->format('Y-m-d h:m:s'),
                'estado_actividad_id' => $request['estado_actividad_id'],
                'documento' => $urlPathDocument
            ]);

        } else if($request['estado_actividad_id'] == 3 || $request['estado_actividad_id'] == 4){

            $actividad_cliente->update([
                'progreso' => $request['progreso']
            ]);

            $reporteActividad->update([
                'estado_actividad_id' => $request['estado_actividad_id'],
                'justificacion' => $request['justificacion'],
                'documento' => $urlPathDocument
            ]);
        } else if($request['estado_actividad_id'] == 5) {

            $actividad_cliente->update([
                'usuario_id' => $request['usuario_id'],
            ]);

            $reporteActividad->update([
                'estado_actividad_id' => 1,
                'fecha_inicio' => null
            ]);
        } else if($request['estado_actividad_id'] == 7) {
            $actividad_cliente->update([
                'progreso' => '100'
            ]);

            $reporteActividad->update([
                'estado_actividad_id' => $request['estado_actividad_id'],
                'documento' => $urlPathDocument
            ]);
        } 

        return redirect()->route('admin.actividad_cliente.index')->with('message', 'Se ha actualizado exitosamente la actividad.')->with('color', 'success');

    }

    public function load_file_create($request, $id, $input, $path, $basePath)
    {
        if ($request->file($input)) {
            $file = $request->file($input);
            $filename = $input . '-' . $id . '-' . date('Y-m-d') . '.' . $file->getClientOriginalExtension();
            $fullPath = $basePath . '/' . $path . '/' . $filename;
    
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            $file->move($basePath . '/' . $path, $filename);
            $request->merge([$path => $filename]);
        }
    }

    public function load_file_update($request, $id, $input, $path, $basePath, $oldName)
    {
        if ($request->file($input)) {
            $file = $request->file($input);
            $filename = $input . '-' . $id . '-' . date('Y-m-d') . '.' . $file->getClientOriginalExtension();
            $fullPath = $basePath . '/' . $path . '/' . $filename;
            
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            if ($oldName && file_exists($basePath . '/' . $path . '/' . $oldName)) {
                unlink($basePath . '/' . $path . '/' . $oldName);
            }
            $file->move($basePath . '/' . $path, $filename);
            return $filename;
        } else {
            return $oldName;
        }
    }

    public function activity_notification()
    {
        // *** Actividades con fecha de vencimiento del dia actual y recordatorios de vencimiento de dias futuros
        $this->getFutureActivities();

        // *** Actividades con fecha de vencimiento pasadas sin estado de actividad "finalizado"
        $this->getExpiredActivities();
    }

    private function getFutureActivities()
    {
        $actividades = ActividadCliente::where('fecha_vencimiento', '>=', date('Y-m-d'))->get(); 
        foreach ($actividades as $actividad) {
            // *** Declara variables
            $destination = $actividad->usuario->email;
            $subject = 'Estimado/a '.$actividad->usuario->nombres.' '.$actividad->usuario->apellidos.',';

            // *** Formato de texto para la fecha
            Carbon::setLocale('es');
            $date = Carbon::createFromFormat('Y-m-d', $actividad->fecha_vencimiento);

            // *** Fecha vencida
            $expired_message = $this->expired($date->isoFormat('D [de] MMMM [de] YYYY'), $actividad->nombre);

            // *** Fecha recordatorio
            $reminder_message = $this->reminder($date->isoFormat('D [de] MMMM [de] YYYY'), $actividad->nombre);

            if ($date->isSameDay(date('Y-m-d'))) {
                $titulo = "Recordatorio de: " . $actividad->nombre;
                Mail::to($destination)->send(new NotificacionActividades($subject, $expired_message, $titulo));
            }
            else{
                // *** Repite la cantidad de recordatorios
                for ($i = 0; $i < $actividad->recordatorio; $i++) { 
                    // *** Resta la cantidad de dias entre recordatorios
                    $date->subDays($actividad->recordatorio_distancia);
                    if ($date->isSameDay(date('Y-m-d'))) {
                        $titulo = "Recordatorio de: " . $actividad->nombre;
                        Mail::to($destination)->send(new NotificacionActividades($subject, $reminder_message, $titulo));
                    }
                }
            }
        }
    }

    private function getExpiredActivities()
    {
        $actividades = ReporteActividad::with(['actividad_clientes' => function ($query) {
            $query->where('fecha_vencimiento', '<', date('Y-m-d'));
        }, 'actividad_clientes.usuario'])->where('estado_actividad_id', '!=', 7)->get();
        foreach ($actividades as $actividad) {
            if(isset($actividad->actividad_clientes)){
                // *** Declara variables
                $destination = $actividad->actividad_clientes->usuario->email;
                $subject = 'Estimado/a '.$actividad->actividad_clientes->usuario->nombres.' '.$actividad->actividad_clientes->usuario->apellidos.',';

                // *** Formato de texto para la fecha
                Carbon::setLocale('es');
                $date = Carbon::createFromFormat('Y-m-d', $actividad->actividad_clientes->fecha_vencimiento);

                // *** Fecha vencida
                $expired_message = $this->expired($date->isoFormat('D [de] MMMM [de] YYYY'), $actividad->actividad_clientes->nombre);
                $titulo = "Urgente - actividad vencida: " . $actividad->actividad_clientes->nombre;

                Mail::to($destination)->send(new NotificacionActividades($subject, $expired_message, $titulo));
            } 
        }
    }

    private function expired($date, $nombre)
    {
        $message = 'Esperamos que se encuentre bien. Queremos recordarle que la fecha de vencimiento de la actividad que tiene asignada con el nombre registrado '.$nombre.', ha pasado. ';
        $message .= 'Le recomendamos encarecidamente que revise el estado actual de la actividad para asegurarse de que todo esté en orden. ';
        $message .= 'La fecha de vencimiento era el '. $date .'.<br><br>';
        $message .= 'Si ya ha completado la actividad o ha tomado medidas al respecto, le agradecemos su diligencia. ';
        $message .= 'Si necesita alguna extensión de plazo o asistencia adicional, no dude en ponerse en contacto con nosotros. <br><br>';
        $message .= 'Atentamente, Estrategia Contributo.';
        return $message;
    }

    private function reminder($date, $nombre)
    {
        $message = 'Esperamos que esté teniendo un buen día. Queremos informarle que la fecha de vencimiento de la actividad que tiene asignada con el nombre registrado '.$nombre.', se aproxima. ';
        $message .= 'Para su conveniencia, le sugerimos revisar el estado actual de la actividad y asegurarse de que esté en camino de cumplirse antes del '. $date .'.<br><br>';
        $message .= 'Si necesita más tiempo, recursos adicionales o tiene alguna pregunta sobre la actividad, estamos aquí para ayudar. ';
        $message .= 'No dude en ponerse en contacto con nosotros para cualquier tipo de apoyo que pueda requerir. <br><br>Gracias por su atención y colaboración.<br><br>';
        $message .= 'Atentamente, Estrategia Contributo.';
        return $message;
    }

    
    public function showEmpresa($responsableActividad)
    {
        if($responsableActividad == 2){
            $empresas = Empresa::select('id', 'razon_social')->where('id', 1)->get()->toJson();
        } else {
            $empresas = Empresa::select('id', 'razon_social')->whereNotIn('id', [1])->get()->toJson();
        }
       
        return $empresas;
    }

    public function showResponsable($empresa)
    {
        if($empresa == 1){
            $responsable = User::select('id', 'nombres', 'apellidos')->whereNotIn('rol_id', [6,7])->get()->toJson();
        } else {
            $responsable = EmpleadoCliente::select('user_id as id', 'nombres', 'apellidos')->where('empresa_id', $empresa)->get()->toJson();
        }
       
        return $responsable;
    }

    public function update_activities(){
        $this->expired_activities();
    }

    private function expired_activities() {

        $actividades = ActividadCliente::select('fecha_vencimiento','reporte_actividad_id')->get();

        $today = Carbon::now()->format('Y-m-d');

        foreach ($actividades as $actividad){

            $reporteActividad = ReporteActividad::where('id', $actividad->reporte_actividad_id)->first();

            if($actividad->fecha_vencimiento < $today && $reporteActividad->estado_actividad_id != 7){
                $reporteActividad->update([
                    'estado_actividad_id' => 6
                ]);

            }
        }
    }

    public function masivoactividades()
    {
        //se llena un array con los datos de las listas desplegables para el excel con  los datos de bd
        $datosParaExcel=$this->datosparaplantilla();
       // Luego, actualiza el archivo Excel utilizando la clase de exportación
        $export = new ActividadClienteExport($datosParaExcel);
        $export->array();
        $ruta =public_path('data/ActividadCliente/MasivoActividades.xlsx');
        // Después de la actualización, descarga el archivo
        return response()->download($ruta, 'MasivoActividades.xlsx');
        
    }

    public function importExcel(Request $request)
    {
        //obtener el archivo  
        $file = $request->file('masivo');
        //validar si se cargo el archivo
        if (!isset($file)) {
                return back()->with('message2', 'Por favor, cargue el archivo correspondiente para continuar.')->with('color', 'warning');
        }
        $job = new ExcelActividadClienteBatchImport($file->getRealPath());
        dispatch($job);
        // Session::flash('file_upload_completed', true);
            // Redireccionar a la vista de importación con un mensaje de éxito
        return back();
    }

   private function datosparaplantilla(){
        $actividades = Actividad::pluck('nombre','id')->toArray();
        $responsables = Responsable::pluck('nombre','id')->toArray();
        $empresas = Empresa::pluck('razon_social','id')->toArray();
        $users = User::pluck('nombres','id')->toArray();
        $clientes = EmpleadoCliente::pluck('nombres','id')->toArray();
        $estados = EstadoActividad::pluck('nombre','id')->toArray();
        // Combina los datos de todas las tablas en un solo array con subarrays
        $datosParaExcel = [
            'actividades' => [],
            'responsables' => [],
            'empresas' => [],
            'clientes' => [],
            'users' => [],
            'estados' => [],
        ];

        foreach ($actividades as $id => $nombre) {
            $datosParaExcel['actividades'][] = "$id-$nombre";
        }

        foreach ($responsables as $id => $nombre) {
            $datosParaExcel['responsables'][] = "$id-$nombre";
        }

        foreach ($empresas as $id => $razonSocial) {
            $datosParaExcel['empresas'][] = "$id-$razonSocial";
        }

        foreach ($clientes as $id => $nombres) {
            $datosParaExcel['clientes'][] = "$id-$nombres";
        }

        foreach ($users as $id => $nombres) {
            $datosParaExcel['users'][] = "$id-$nombres";
        }

        foreach ($estados as $id => $nombre) {
            $datosParaExcel['estados'][] = "$id-$nombre";
        }

        return $datosParaExcel;
   }

}