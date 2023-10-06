<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Actividad;
use App\Models\EstadoActividad;
use App\Models\ActividadCliente;
use App\Http\Requests\CreateInformeEmpresaUsuarioRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActividadEmpresaUsuarioExport;

class InformeEmpresaUsuarioController extends Controller
{
    public function index() {

        $empresa = Empresa::select('id','razon_social')->orderBy('razon_social')->get();
        $usuarios = User::select('id','nombres', 'apellidos')->orderBy('nombres')->whereNotIn('rol_id', [6,7])->get();
        $tipo_actividad = Actividad::select('id', 'nombre')->get();

        return view('admin.informes.informe-empresa-usuario-index', compact('empresa', 'usuarios', 'tipo_actividad'));
    }

        // Genera un excel por empresa en general y tambien genera por tipo de actividad dependiendo de las fechas
        public function getInformeEmpresaUsuario(CreateInformeEmpresaUsuarioRequest $request) {

            $clienteId = $request['empresa'];
            $actividadId = $request['tipo_actividad_id'];
            $usuarioId = $request['usuario'];
            $fechaInicio = $request['fecha_inicio'];
            $fechaFin = $request['fecha_fin'];
            
            // $informe debe contener las columnas
            //empresa, cant_actividades, estado actividad, actividad, porcentaje y total actividades
            $estados = EstadoActividad::select('nombre', 'id')->get();
            $tipo_actividad = Actividad::select('nombre', 'id')->get();
            $nombre_actividad = Actividad::select('nombre')->where('id', $actividadId)->first();
    
            $cantidadActividadesEstado = [];
            $cantidadActividades = [];
    
             // total de actividades
             if($clienteId){
                $totalActividades = ActividadCliente::where('empresa_asociada_id', $clienteId)->where('usuario_id', $usuarioId)->count();
             } else{
                $totalActividades = ActividadCliente::where('usuario_id', $usuarioId)->count();
             }       
    
             if($totalActividades == 0) {
                return redirect()->back()->with('message', 'No existen datos relacionados al usuario con las opciones seleccionadas')->with('color', 'danger');
             }
    
            //traer la cantidad de actividades por tipo de actividad y estado de actividad
            
           
            if($actividadId && $clienteId){
                 //trae todas las actividades por usuario, empresa asociada y tipo de actividad
                $informe = ActividadCliente::where('usuario_id', $usuarioId)
                                            ->where('empresa_asociada_id', $clienteId)
                                            ->where('actividad_id', $actividadId)
                                            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                            ->whereHas('actividad', function ($query) use ($actividadId) {
                                                $query->where('id', $actividadId);
                                            })
                                            ->with(['actividad','empresa_asociada', 'reporte_actividades'])->get();   
                                            
                  $nombre_empresa = Empresa::where('id', $clienteId)->first();

            }elseif($clienteId){
                //  trae todas las actividades por usuario y empresa asociada
                $informe = ActividadCliente::where('usuario_id', $usuarioId)
                                            ->where('empresa_asociada_id', $clienteId )
                                            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                            ->with(['actividad','empresa_asociada', 'reporte_actividades'])
                                            ->groupBy('empresa_asociada_id')->get();    
                                            
            }else{

                //trae todas las actividades por usuario
                $informe = ActividadCliente::where('usuario_id', $usuarioId)
                                            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                            ->with(['actividad','empresa_asociada','reporte_actividades'])
                                            ->groupBy('empresa_asociada_id')->get();
            }
            

            //consulta todas las actividades por estado de actividdd
                foreach($informe as $informe){   
                    foreach($estados as $estado){
    
                        if($actividadId) {
                            $contado = $informe->where('empresa_asociada_id', $informe->empresa_asociada_id)
                            ->where('usuario_id', $usuarioId)
                            ->where('actividad_id', $informe->actividad_id)
                            ->whereHas('reporte_actividades', function ($query) use ($estado) {
                                 $query->where('estado_actividad_id', $estado->id);
                             })->count();
                        } else {
                            $contado = $informe->where('empresa_asociada_id', $informe->empresa_asociada_id)
                            ->where('usuario_id', $usuarioId)
                            ->whereHas('reporte_actividades', function ($query) use ($estado) {
                                 $query->where('estado_actividad_id', $estado->id);
                             })->count();
                        }
                        
                    

                    if($estado->id == 1) {
                        $programado = [
                            'empresa' => $informe->empresa_asociada->razon_social,
                            'cantidad' =>  $contado,
                            'estado' => $estado->nombre,
                            'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                          ];
                          array_push($cantidadActividadesEstado, $programado);
                    } else if($estado->id == 2) {
                        $proceso = [
                            'empresa' => $informe->empresa_asociada->razon_social,
                            'cantidad' =>  $contado,
                            'estado' => $estado->nombre,
                            'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                          ];
                          array_push($cantidadActividadesEstado, $proceso);
                    }else if($estado->id == 3) {
                        $pausado = [
                            'empresa' => $informe->empresa_asociada->razon_social,
                            'cantidad' =>  $contado,
                            'estado' => $estado->nombre,
                            'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                        ];
                          array_push($cantidadActividadesEstado, $pausado);
                    }else if($estado->id == 4) {
                        $cancelado = [
                            'empresa' => $informe->empresa_asociada->razon_social,
                            'cantidad' =>  $contado,
                            'estado' => $estado->nombre,
                            'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                          ];
                          array_push($cantidadActividadesEstado, $cancelado);
                    }else if($estado->id == 6) {
                        $vencido = [
                            'empresa' => $informe->empresa_asociada->razon_social,
                            'cantidad' =>  $contado,
                            'estado' => $estado->nombre,
                            'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                          ];
                          array_push($cantidadActividadesEstado, $vencido);
                    }else if($estado->id == 7) {
                        $finalizado = [
                            'empresa' => $informe->empresa_asociada->razon_social,
                            'cantidad' =>  $contado,
                            'estado' => $estado->nombre,
                            'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                          ];
                          array_push($cantidadActividadesEstado, $finalizado);
                    }  
                }   
            }
            
           

            
            if($actividadId  && $clienteId){
                //Trae las actividades por usuario, empresa asociada y tipo de actividad seleccionado
                $informe = ActividadCliente::where('usuario_id', $usuarioId)
                                            ->where('empresa_asociada_id', $clienteId )
                                            ->where('actividad_id', $actividadId)
                                            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                            ->whereHas('actividad', function ($query) use ($actividadId) {
                                                $query->where('id', $actividadId);
                                            })
                                            ->with(['actividad','empresa_asociada', 'reporte_actividades'])->get(); 

                    if($informe->count() > 0) {
                            $actividad =  [
                                'empresa' => $nombre_empresa->razon_social,
                                'cantidad' =>  $informe->count(),
                                'tipo_actividad' => $nombre_actividad->nombre,
                                'porcentaje' => ($informe->count() / $totalActividades) * 100 . '%'
                            ];

                            
                            array_push($cantidadActividades, $actividad); 
                    } else {
                        return redirect()->back()->with('message', 'No existen datos relacionados al usuario con las opciones seleccionadas')->with('color', 'danger');
                    }

            } elseif($clienteId){
                // Trae las actividades por usuario, empresa asociada y todos los tipos de actividad
                $informe = ActividadCliente::where('usuario_id', $usuarioId)
                                            ->where('empresa_asociada_id', $clienteId)
                                            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                            ->with(['actividad','empresa_asociada', 'reporte_actividades'])->first(); 

                if($informe->count() > 0) {
                        foreach($tipo_actividad as $tipo_actividad) {
                            $contado = $informe->where('empresa_asociada_id',$informe->empresa_asociada_id)
                            ->where('usuario_id', $usuarioId)
                            ->whereHas('actividad', function ($query) use ($tipo_actividad) {
                                       $query->where('id', $tipo_actividad->id);
                            })->count();

                          
                            if($tipo_actividad->id == 1) {
                                $cierremes = [
                                    'empresa' => $informe->empresa_asociada->razon_social,
                                    'cantidad' =>  $contado,
                                    'tipo_actividad' => $tipo_actividad->nombre,
                                    'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                                ];
                                array_push($cantidadActividades, $cierremes);
                            } else if($tipo_actividad->id == 2) {
                                $solicitudes = [
                                    'empresa' => $informe->empresa_asociada->razon_social,
                                    'cantidad' =>  $contado,
                                    'tipo_actividad' => $tipo_actividad->nombre,
                                    'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                                ];
                                array_push($cantidadActividades, $solicitudes);
                            }else if($tipo_actividad->id == 3) {
                                $prioritario = [
                                    'empresa' => $informe->empresa_asociada->razon_social,
                                    'cantidad' =>  $contado,
                                    'tipo_actividad' => $tipo_actividad->nombre,
                                    'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                                ];
                                array_push($cantidadActividades, $prioritario);
                            }else if($tipo_actividad->id == 4) {
                                $otro = [
                                    'empresa' => $informe->empresa_asociada->razon_social,
                                    'cantidad' =>  $contado,
                                    'tipo_actividad' => $tipo_actividad->nombre,
                                    'porcentaje' => ($contado / $totalActividades) * 100 . '%'
                                ];
                                array_push($cantidadActividades, $otro);
                            }
                        }
               
                } else {
                    return redirect()->back()->with('message', 'No existen datos relacionados al usuario con las opciones seleccionadas')->with('color', 'danger');
                }

            }else {

                $informe = ActividadCliente::where('usuario_id', $usuarioId)
                                            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin])
                                            ->with(['actividad','empresa_asociada','reporte_actividades'])
                                            ->groupBy('empresa_asociada_id')->get();                             

                  //Trae las actividades por usuario, por todas las empresas y todos los tipos de actividad

                  foreach ($informe as $informe) {
                    foreach($tipo_actividad as $tipo){
                        $contado = $informe->where('empresa_asociada_id', $informe->empresa_asociada_id)
                        ->where('usuario_id', $usuarioId)
                        ->whereHas('actividad', function ($query) use ($tipo) {
                                                $query->where('id', $tipo->id);
                        })->count();

                        if($tipo->id == 1) {
                            $cierremes = [
                                'empresa' => $informe->empresa_asociada->razon_social,
                                'cantidad' =>  $contado ,
                                'tipo_actividad' => $tipo->nombre,
                                'porcentaje' => ($contado  / $totalActividades) * 100 . '%'
                            ];
                            array_push($cantidadActividades, $cierremes);
                        } else if($tipo->id == 2) {
                            $solicitudes = [
                                'empresa' => $informe->empresa_asociada->razon_social,
                                'cantidad' =>  $contado ,
                                'tipo_actividad' => $tipo->nombre,
                                'porcentaje' => ($contado  / $totalActividades) * 100 . '%'
                            ];
                            array_push($cantidadActividades, $solicitudes);
                        }else if($tipo->id == 3) {
                            $prioritario = [
                                'empresa' => $informe->empresa_asociada->razon_social,
                                'cantidad' =>  $contado ,
                                'tipo_actividad' => $tipo->nombre,
                                'porcentaje' => ($contado  / $totalActividades) * 100 . '%'
                            ];
                            array_push($cantidadActividades, $prioritario);
                        }else if($tipo->id == 4) {
                            $otro = [
                                'empresa' => $informe->empresa_asociada->razon_social,
                                'cantidad' =>  $contado ,
                                'tipo_actividad' => $tipo->nombre,
                                'porcentaje' => ($contado  / $totalActividades) * 100 . '%'
                            ];
                            array_push($cantidadActividades, $otro);
                        }
                     }
                  }
           }
           
            $usuario = User::select('nombres', 'apellidos')->where('id', $request['usuario'])->first();

            return Excel::download(new ActividadEmpresaUsuarioExport($cantidadActividadesEstado, $cantidadActividades), 'INFORME_ACTIVIDADES_EMPRESA_'. $usuario->nombres . '_'. $usuario->apellidos . '.xlsx');
        }
}
