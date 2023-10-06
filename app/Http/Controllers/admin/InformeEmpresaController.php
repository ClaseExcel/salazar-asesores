<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Exports\ActividadEmpresasExport;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\ActividadCliente;
use App\Models\ReporteActividad;
use App\Models\EstadoActividad;
use App\Models\Actividad;
use App\Http\Requests\CreateInformeEmpresaRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InformeEmpresaController extends Controller
{
    public function index(){
        $empresa = Empresa::select('id','razon_social')->orderBy('razon_social')->get();
        $tipo_actividad = Actividad::select('id', 'nombre')->get();

        return view('admin.informes.informe-empresa-index', compact('empresa', 'tipo_actividad'));
    }

    // Genera un excel por empresa en general y tambien genera por tipo de actividad dependiendo de las fechas
    public function getInformeEmpresa(CreateInformeEmpresaRequest $request) {

        $clienteId = $request['empresa'];
        $actividadId = $request['tipo_actividad_id'];
        $fechaInicio = $request['fecha_inicio'];
        $fechaFin = $request['fecha_fin'];
        
        // $informe debe contener las columnas
        // cant_actividades, estado actividad, actividad, porcentaje y total actividades

        
        //traer el estado de la actividad
        $estados = EstadoActividad::select('nombre', 'id')->get();
        $tipo_actividad = Actividad::select('nombre', 'id')->get();

        $nombre_actividad = Actividad::select('nombre')->where('id', $actividadId)->first();

        $cantidadActividadesEstado = [];
        $cantidadActividades = [];

         // total de actividades
         $totalActividades = ActividadCliente::where('cliente_id', $clienteId)->count();

         if($totalActividades == 0) {
            return redirect()->back()->with('message', 'No existen datos relacionados a este tipo de actividad')->with('color', 'danger');
         }

        //traer la cantidad de actividades por tipo de actividad y estado de actividad
        foreach($estados as $estado){

            if($actividadId){
                $informe = ActividadCliente::where('cliente_id', $clienteId )
                                                        ->where('actividad_id', $actividadId)
                                                        ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                                        ->whereHas('reporte_actividades', function ($query) use ($estado) {
                                                            $query->where('estado_actividad_id', $estado->id);
                                                        })
                                                        ->with(['actividad','cliente', 'reporte_actividades'])->get();           
            }else{
                $informe = ActividadCliente::where('cliente_id', $clienteId )
                                                        ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                                        ->whereHas('reporte_actividades', function ($query) use ($estado) {
                                                            $query->where('estado_actividad_id', $estado->id);
                                                        })
                                                        ->with(['actividad','cliente', 'reporte_actividades']);
            }
          

            if($estado->id == 1) {
                $programado = [
                    'cantidad' =>  $informe->count(),
                    'estado' => $estado->nombre,
                    'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                  ];
                  array_push($cantidadActividadesEstado, $programado);
            } else if($estado->id == 2) {
                $proceso = [
                    'cantidad' =>  $informe->count(),
                    'estado' => $estado->nombre,
                    'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                  ];
                  array_push($cantidadActividadesEstado, $proceso);
            }else if($estado->id == 3) {
                $pausado = [
                    'cantidad' =>  $informe->count(),
                    'estado' => $estado->nombre,
                    'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                ];
                  array_push($cantidadActividadesEstado, $pausado);
            }else if($estado->id == 4) {
                $cancelado = [
                    'cantidad' =>  $informe->count(),
                    'estado' => $estado->nombre,
                    'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                  ];
                  array_push($cantidadActividadesEstado, $cancelado);
            }else if($estado->id == 6) {
                $vencido = [
                    'cantidad' =>  $informe->count(),
                    'estado' => $estado->nombre,
                    'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                  ];
                  array_push($cantidadActividadesEstado, $vencido);
            }else if($estado->id == 7) {
                $finalizado = [
                    'cantidad' =>  $informe->count(),
                    'estado' => $estado->nombre,
                    'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                  ];
                  array_push($cantidadActividadesEstado, $finalizado);
            }
           
        }
      

            if($actividadId){
                $informe = ActividadCliente::where('cliente_id', $clienteId )
                                                        ->where('actividad_id', $actividadId)
                                                        ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                                        ->whereHas('actividad', function ($query) use ($actividadId) {
                                                            $query->where('id', $actividadId);
                                                        })
                                                        ->with(['actividad','cliente', 'reporte_actividades']); 
                
                    if($informe->count() > 0) {
                        $actividad =  [
                            'cantidad' =>  $informe->count(),
                            'tipo_actividad' => $nombre_actividad->nombre,
                            'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                        ];
                    } else {
                        return redirect()->back()->with('message', 'No existen datos relacionados a este tipo de actividad')->with('color', 'danger');
                    }
    
                    array_push($cantidadActividades, $actividad);                   
              
            }else {
                foreach($tipo_actividad as $tipo_actividad){

                    $informe = ActividadCliente::where('cliente_id', $clienteId )
                                                            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                                            ->where('actividad_id', $tipo_actividad->id)
                                                            ->with(['actividad','cliente', 'reporte_actividades']);

                if($tipo_actividad->id == 1) {
                    $cierremes = [
                        'cantidad' =>  $informe->count(),
                        'tipo_actividad' => $tipo_actividad->nombre,
                        'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                    ];
                    array_push($cantidadActividades, $cierremes);
                } else if($tipo_actividad->id == 2) {
                    $solicitudes = [
                        'cantidad' =>  $informe->count(),
                        'tipo_actividad' => $tipo_actividad->nombre,
                        'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                    ];
                    array_push($cantidadActividades, $solicitudes);
                }else if($tipo_actividad->id == 3) {
                    $prioritario = [
                        'cantidad' =>  $informe->count(),
                        'tipo_actividad' => $tipo_actividad->nombre,
                        'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                    ];
                    array_push($cantidadActividades, $prioritario);
                }else if($tipo_actividad->id == 4) {
                    $otro = [
                        'cantidad' =>  $informe->count(),
                        'tipo_actividad' => $tipo_actividad->nombre,
                        'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                    ];
                    array_push($cantidadActividades, $otro);
                }
            
            }
        }
       
        $empresa = Empresa::select('razon_social')->where('id', $request['empresa'])->first();
        return Excel::download(new ActividadEmpresasExport($cantidadActividadesEstado, $cantidadActividades), 'INFORME_ACTIVIDADES_EMPRESA_'.$empresa->razon_social.'.xlsx');
    }
}
