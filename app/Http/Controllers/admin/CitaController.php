<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AgendaEmpleado;
use App\Models\EmpleadoCliente;
use App\Models\Cita;
use App\Models\Modalidad;
use App\Http\Requests\CreateCitaRequest;
use App\Http\Requests\UpdateCitaRequest;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user()->id;

        $usuario_cliente = EmpleadoCliente::where('user_id', $usuario)->first();
        $agenda = AgendaEmpleado::select('*')->where('empresa_id', $usuario_cliente->empresa_id)->get();
        $citas = Cita::all();

        $events = [];

        foreach ($agenda as $agenda) {
            $events[] =
                    [
                        'id' => $agenda->id,
                        'start' => $agenda->fecha_disponibilidad . ' ' . $agenda->hora_inicio,
                        'end' => $agenda->fecha_disponibilidad . ' ' . $agenda->hora_fin,
                        'allDay' => false,
                        'backgroundColor' => '#0075F6',
                        'borderColor' => '#0075F6',
                        'textColor' => '#fff'
                    ];
        }

        $modalidades = Modalidad::all();

        return view('admin.citas.calendario', compact('usuario_cliente','modalidades', 'citas'), ['cita' => new Cita])->with('events', $events);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCitaRequest $request)
    {
        Cita::create($request->all());
        return response()->json(['success' => 300]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cita = Cita::find($id);
        $cliente_logged = EmpleadoCliente::where('user_id', Auth::user()->id)->first();

        if($cita->empleado_cliente_id == $cliente_logged->id) {
            return $cita;
        }

        return 0;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCitaRequest $request, $id)
    {
        $cita = Cita::find($id);
        $cita->update($request->all());

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::find($id);
        $cliente_logged = EmpleadoCliente::where('user_id', Auth::user()->id)->first();

        if($cita->empleado_cliente_id == $cliente_logged->id) {
            $cita->update(['estados' => 3]);
            return true;
        }
     

        return 0;
    }
}
