<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Actividad;
use App\Models\EstadoActividad;
use App\Models\EmpleadoCliente;
use App\Models\ActividadCliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateInformeUsuarioRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActividadUsuariosExport;

class InformeUsuarioController extends Controller
{
    public function index(){

        $empleado = EmpleadoCliente::where('user_id', Auth::user()->id)->first();
        $empresa = Empresa::where('id', $empleado->empresa_id)->get();
        
        $tipo_actividad = Actividad::select('id', 'nombre')->get();

        return view('admin.informes.informe-usuario-index', compact('empresa', 'tipo_actividad'));
    }

    //si es admin o contador traer todas las empresas y usuarios, si es cliente traer la empresa a la que pertenece y todos los empleados de dicha empresa
    public function showUsuario($empresa)
    {

        $responsable = EmpleadoCliente::select('user_id as id', 'nombres', 'apellidos')->where('empresa_id', $empresa)->orderBy('nombres')->get()->toJson();
       
        return $responsable;
    }

    public function getInformeUsuario(CreateInformeUsuarioRequest $request) {


        $clienteId = $request['empresa'];
        $usuarioId = $request['usuario'];
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
         $totalActividades = ActividadCliente::where('cliente_id', $clienteId)->where('usuario_id', $usuarioId)->count();

         if($totalActividades == 0) {
            return redirect()->back()->with('message', 'No existen datos relacionados a este tipo de actividad')->with('color', 'danger');
         }

        //traer la cantidad de actividades por tipo de actividad y estado de actividad realizadas por un usuario
        foreach($estados as $estado){

            if($actividadId){
                $informe = ActividadCliente::where('cliente_id', $clienteId )
                                                        ->where('actividad_id', $actividadId)
                                                        ->where('usuario_id', $usuarioId)
                                                        ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                                        ->whereHas('reporte_actividades', function ($query) use ($estado) {
                                                            $query->where('estado_actividad_id', $estado->id);
                                                        })
                                                        ->with(['actividad','cliente', 'reporte_actividades', 'usuario'])->get();           
            }else{
                $informe = ActividadCliente::where('cliente_id', $clienteId )
                                                        ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                                        ->where('usuario_id', $usuarioId)
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
                                            ->where('usuario_id', $usuarioId)
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
                                                ->where('usuario_id', $usuarioId)
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
        $usuario = User::select('nombres', 'apellidos')->where('id', $request['usuario'])->first();

        return Excel::download(new ActividadUsuariosExport($cantidadActividadesEstado, $cantidadActividades), 'INFORME_ACTIVIDADES_'.$empresa->razon_social.'_'. $usuario->nombres . '_'. $usuario->apellidos . '.xlsx');
    }

}
