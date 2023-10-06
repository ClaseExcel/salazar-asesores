<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeguimientoRequerimiento;
use App\Models\EstadoRequerimiento;
use App\Models\TipoRequerimiento;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\seguimientoRequerimientos;
use App\Mail\asociadoRequerimiento;
use App\Http\Requests\UpdateSeguimientoRequerimientoRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Documento;

class RequerimientoEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requerimientos = SeguimientoRequerimiento::whereNotIn('estado_requerimiento_id', [6])->get();

        return view('admin.requerimiento-empleado.index', compact('requerimientos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requerimientos = SeguimientoRequerimiento::whereNotIn('estado_requerimiento_id', [6])->where('user_id', $id)->get();

        return view('admin.requerimiento-empleado.index-seguimiento', compact('requerimientos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $requerimiento = SeguimientoRequerimiento::find($id);

       $estados = EstadoRequerimiento::whereNotIn('id', [1,4,5,6])->get();
       $tipo_requerimientos = TipoRequerimiento::pluck('nombre', 'id')->prepend('Selecciona un requerimiento');
       $responsables = User::whereNotIn('rol_id', [6,7])->get();
       $documento = Documento::where('requerimiento_id', $id)->first();

       return view('admin.requerimiento-empleado.edit', compact('requerimiento', 'estados', 'tipo_requerimientos', 'responsables', 'documento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeguimientoRequerimientoRequest $request, $id)
    {
        $requerimiento = SeguimientoRequerimiento::find($id);
        $correo_cliente = $requerimiento->requerimientos->empleado_clientes->correo_electronico;
        $usuario_cliente = $requerimiento->requerimientos->empleado_clientes->nombres . ' ' . $requerimiento->requerimientos->empleado_clientes->apellidos;

        $requerimiento->update([
            'observacion' => $request['observacion'],
            'fecha_vencimiento' => Carbon::createFromFormat('m/d/Y', $request['fecha_vencimiento'])->format('Y-m-d'),
            'user_id' => $request['user_id'],
            'estado_requerimiento_id' => $request['estado_requerimiento_id']
        ]);

        $responsable = User::find($request['user_id']);
        $estado = EstadoRequerimiento::find($request['estado_requerimiento_id']);

        Mail::to($responsable->email)
        ->send(new asociadoRequerimiento($requerimiento->requerimientos->consecutivo, 
        $usuario_cliente, $requerimiento->requerimientos->tipo_requerimientos->nombre));

        Mail::to($correo_cliente)
        ->send(new seguimientoRequerimientos($requerimiento->requerimientos->consecutivo, $request['observacion'], $request['estado_requerimiento_id'], $usuario_cliente, $estado->nombre));

        return redirect()->route('admin.requerimientos.empleado.index')->with('message', 'Requerimiento actualizado exitosamente.')->with('color', 'success');
    }


    /**
     * Muestra los requerimientos asignados para el empleado estrategia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSeguimiento($id)
    {
       $requerimiento = SeguimientoRequerimiento::find($id);

       if($requerimiento->estado_requerimiento_id == 4){
        $estados = EstadoRequerimiento::whereNotIn('id', [1,2,3,4,6])->get();
       } else {
        $estados = EstadoRequerimiento::whereNotIn('id', [1,2,3,6])->get();
       }

       $tipo_requerimientos = TipoRequerimiento::pluck('nombre', 'id')->prepend('Selecciona un requerimiento');
       $documento = Documento::where('requerimiento_id', $id)->first();

       return view('admin.requerimiento-empleado.edit-seguimiento', compact('requerimiento', 'estados', 'tipo_requerimientos', 'documento'));
    }

    /**
     * Actualiza el requerimiento editado por el empleado de Estrategia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSeguimiento(UpdateSeguimientoRequerimientoRequest $request, $id)
    {
        $requerimiento = SeguimientoRequerimiento::find($id);
        $correo_cliente = $requerimiento->requerimientos->empleado_clientes->correo_electronico;
        $usuario_cliente = $requerimiento->requerimientos->empleado_clientes->nombres . ' ' . $requerimiento->requerimientos->empleado_clientes->apellidos;


        $requerimiento->update([
            'observacion' => $request['observacion'],
            'estado_requerimiento_id' => $request['estado_requerimiento_id']
        ]);

        $estado = EstadoRequerimiento::find($request['estado_requerimiento_id']);

        Mail::to($correo_cliente)
        ->send(new seguimientoRequerimientos($requerimiento->requerimientos->consecutivo, $request['observacion'], $request['estado_requerimiento_id'], $usuario_cliente, $estado->nombre));

        return redirect()->route('admin.requerimientos.empleado.show', Auth::user()->id)->with('message', 'Requerimiento actualizado exitosamente.')->with('color', 'success');
    }

}
