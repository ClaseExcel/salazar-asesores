<?php

use Illuminate\Support\Facades\Route;
use App\Models\EmpleadoCliente;
use App\Models\ActividadCliente;
use App\Models\ReporteActividad;
use App\Models\SeguimientoRequerimiento;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login'); //era un welcome
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        $user = Auth::user();

        if(in_array(Auth::user()->rol_id, [1, 2])) {
            $actividades = ActividadCliente::select('*')->get();
            $requerimientos = SeguimientoRequerimiento::whereIn('estado_requerimiento_id', [2,4,5])->get();
        } else {
            $actividades = ActividadCliente::select('*')->where('usuario_id', $user->id)->get();
            $requerimientos = [];
        }
   

        $events = [];
        $event_requerimientos = [];

        foreach($requerimientos as $requerimiento){
            $event_requerimientos[] = [
                'id' => $requerimiento->id,
                'title' => $requerimiento->requerimientos->consecutivo . ' - ' . $requerimiento->requerimientos->tipo_requerimientos->nombre,
                'description' => '<b>Requerimiento: </b>' . $requerimiento->requerimientos->consecutivo . ' - ' . $requerimiento->requerimientos->tipo_requerimientos->nombre
                . '</br></br>' . '<b>Fecha de vencimiento: </b> ' . Carbon::parse($requerimiento->fecha_vencimiento)->format('d-m-Y')
                . '</br></br>' . '<b>Fecha de creación: </b> ' . Carbon::parse($requerimiento->requerimientos->created_at)->format('d-m-Y')
                . '</br></br>' . '<b>Descripción requerimiento: </b> ' . $requerimiento->requerimientos->descripcion
                . '</br></br>' . '<b>Observación: </b>' . $requerimiento->observacion
                . '</br></br>' . '<b>Responsable: </b>' . $requerimiento->usuario_responsable->nombres . ' ' . $requerimiento->usuario_responsable->apellidos
                . '</br></br>' . '<b>Estado requerimiento: </b>' . $requerimiento->estado_requerimientos->nombre, 
                'start' => $requerimiento->fecha_vencimiento,
                'end' => $requerimiento->fecha_vencimiento,
                'allDay' => true,
                'backgroundColor' => '#0900C3',
                'borderColor' => '#0900C3',
                'textColor' => '#fff'
            ];
        }

        foreach ($actividades as $actividad) {

            $reporteActividad = ReporteActividad::where('id', $actividad->reporte_actividad_id)->first();

            if($reporteActividad->estado_actividad_id == 7) {
                $color = '#0DA13C';
            } elseif($reporteActividad->estado_actividad_id == 6){
                $color = '#D7001E';
            } else {
                $color = '#0075F6';
            }

            $events[] =
                    [
                        'id' => $actividad->id,
                        'title' => $actividad->nombre . ' - ' . $actividad->cliente->razon_social  ,
                        'description' => '<b>Nombre: </b>' . $actividad->nombre
                        . '</br></br>' . '<b>Progreso: </b> ' . $actividad->progreso . '%'
                        . '</br></br>' . '<b>Fecha de vencimiento: </b> ' . Carbon::parse($actividad->fecha_vencimiento)->format('d-m-Y')
                        . '</br></br>' . '<b>Fecha de creación: </b> ' . Carbon::parse($actividad->created_at)->format('d-m-Y')
                        . '</br></br>' . '<b>Periocidad: </b> ' . $actividad->periocidad
                        . '</br></br>' . '<b>Nota: </b> ' . $actividad->nota
                        . '</br></br>' . '<b>Empresa: </b>' . $actividad->cliente->razon_social
                        . '</br></br>' . '<b>Responsable: </b>' . $actividad->usuario->nombres . ' ' . $actividad->usuario->apellidos
                        . '</br></br>' . '<b>Reporte actividad: </b>' . $reporteActividad->estado_actividades->nombre, 
                        'start' => $actividad->fecha_vencimiento,
                        'end' => $actividad->fecha_vencimiento,
                        'allDay' => true,
                        'backgroundColor' => $color,
                        'borderColor' => $color,
                        'textColor' => '#fff'
                    ];
        }

        if(in_array(Auth::user()->rol_id, [1, 2, 3, 4, 5, 8])){

            $empresas = Empresa::select('id', 'razon_social')->orderBy('razon_social')->get();
            return view('dashboard', compact('empresas', 'event_requerimientos'))->with('events', $events);
        } 

        return view('admin.clientes.dashboard', compact('event_requerimientos'))->with('events', $events);
    
        
    })->name('dashboard');

    Route::get('/actividad-empresa/{id}', function (Request $request, $id) {


        $actividad = ActividadCliente::select('*')->where('cliente_id', $id)->get();

        $events = [];

        foreach ($actividad as $actividad) {

            $reporteActividad = ReporteActividad::where('id', $actividad->reporte_actividad_id)->first();

            if($reporteActividad->estado_actividad_id == 7) {
                $color = '#0DA13C';
            } elseif($reporteActividad->estado_actividad_id == 6){
                $color = '#D7001E';
            } else {
                $color = '#0075F6';
            }

            $events[] =
                    [
                        'id' => $actividad->id,
                        'title' => $actividad->nombre . ' - ' . $actividad->cliente->razon_social  ,
                        'description' => '<b>Nombre: </b>' . $actividad->nombre
                        . '</br></br>' . '<b>Progreso: </b> ' . $actividad->progreso . '%'
                        . '</br></br>' . '<b>Fecha de vencimiento: </b> ' . Carbon::parse($actividad->fecha_vencimiento)->format('d-m-Y')
                        . '</br></br>' . '<b>Fecha de creación: </b> ' . Carbon::parse($actividad->created_at)->format('d-m-Y')
                        . '</br></br>' . '<b>Periocidad: </b> ' . $actividad->periocidad
                        . '</br></br>' . '<b>Nota: </b> ' . $actividad->nota
                        . '</br></br>' . '<b>Empresa: </b>' . $actividad->cliente->razon_social
                        . '</br></br>' . '<b>Responsable: </b>' . $actividad->usuario->nombres . ' ' . $actividad->usuario->apellidos
                        . '</br></br>' . '<b>Reporte actividad: </b>' . $reporteActividad->estado_actividades->nombre, 
                        'start' => $actividad->fecha_vencimiento,
                        'end' => $actividad->fecha_vencimiento,
                        'allDay' => true,
                        'backgroundColor' => $color,
                        'borderColor' => $color,
                        'textColor' => '#fff'
                    ];
        }

        return response()->json($events);   
    });


    Route::get('/actividad-empleado/{id}', function (Request $request, $id) {

        $actividad = ActividadCliente::select('*')->where('usuario_id', $id)->get();
        
        $events = [];

        foreach ($actividad as $actividad) {

            $reporteActividad = ReporteActividad::where('id', $actividad->reporte_actividad_id)->first();

            if($reporteActividad->estado_actividad_id == 7) {
                $color = '#0DA13C';
            } elseif($reporteActividad->estado_actividad_id == 6){
                $color = '#D7001E';
            } else {
                $color = '#0075F6';
            }

            $events[] =
                    [
                        'id' => $actividad->id,
                        'title' => $actividad->nombre . ' - ' . $actividad->cliente->razon_social  ,
                        'description' => '<b>Nombre: </b>' . $actividad->nombre
                        . '</br></br>' . '<b>Progreso: </b> ' . $actividad->progreso . '%'
                        . '</br></br>' . '<b>Fecha de vencimiento: </b> ' . Carbon::parse($actividad->fecha_vencimiento)->format('d-m-Y')
                        . '</br></br>' . '<b>Fecha de creación: </b> ' . Carbon::parse($actividad->created_at)->format('d-m-Y')
                        . '</br></br>' . '<b>Periocidad: </b> ' . $actividad->periocidad
                        . '</br></br>' . '<b>Nota: </b> ' . $actividad->nota
                        . '</br></br>' . '<b>Empresa: </b>' . $actividad->cliente->razon_social
                        . '</br></br>' . '<b>Responsable: </b>' . $actividad->usuario->nombres . ' ' . $actividad->usuario->apellidos
                        . '</br></br>' . '<b>Reporte actividad: </b>' . $reporteActividad->estado_actividades->nombre, 
                        'start' => $actividad->fecha_vencimiento,
                        'end' => $actividad->fecha_vencimiento,
                        'allDay' => true,
                        'backgroundColor' => $color,
                        'borderColor' => $color,
                        'textColor' => '#fff'
                    ];
        }

        return response()->json($events);   
    });
});
