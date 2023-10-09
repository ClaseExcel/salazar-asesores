<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Models\AgendaEmpleado;
use App\Models\EmpleadoCliente;
use App\Models\Empresa;
use Carbon\Carbon;
use App\Models\Cita;
use App\Models\Modalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = AgendaEmpleado::where('user_id', Auth::user()->id)->paginate(10);

        return view('admin.agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Empresa::whereNotIn('id', [1])->select('razon_social', 'id')->get();
        return view('admin.agenda.create', compact('clientes'), ['agenda' => new AgendaEmpleado]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAgendaRequest $request)
    {

        $fecha_disponibilidad = Carbon::createFromFormat('m/d/Y', $request['fecha_disponibilidad'])->format('Y-m-d');

        $exist = AgendaEmpleado::where('fecha_disponibilidad', $fecha_disponibilidad)
        ->get();

        if ($request['fecha_disponibilidad'] <= Carbon::now()->format('m/d/Y')) {
            return redirect()->route('admin.agendas.create')->with('message', 'No puedes crear la agenda con una fecha anterior o igual a la actual.')->with('color', 'danger');
        }

        if($request['hora_fin'] <= $request['hora_inicio']){
            return redirect()->route('admin.agendas.create')->with('message', 'No puedes crear la hora final con una hora anterior o igual a la inicial.')->with('color', 'danger');
        }

        foreach ($exist as $exist) {
            if (Carbon::parse($request['hora_inicio'])->format('H:i:s') >= $exist->hora_inicio && Carbon::parse($request['hora_fin'])->format('H:i:s') <= $exist->hora_fin) {
                return redirect()->route('admin.agendas.create')->with('message', 'Ya existe una agenda con ese horario.')->with('color', 'danger');
            }
        }


        AgendaEmpleado::create([
            'fecha_disponibilidad' => $fecha_disponibilidad,
            'hora_inicio' => $request['hora_inicio'],
            'hora_fin' => $request['hora_fin'],
            'empresa_id' => $request['empresa_id'],
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.agendas.index')->with('message', 'La agenda se ha creado exitosamente.')->with('color', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if($id != Auth::user()->id) {
            abort(401, 'No autorizado');
        }

        $agenda = AgendaEmpleado::select('*')->where('user_id', $id)->get();

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

        return view('admin.agenda.calendario', compact('modalidades', 'citas'), ['cita' => new Cita])->with('events', $events);
    }

    public function empleadoCliente($id){

        $empleado = EmpleadoCliente::where('id', $id)->first();

        $info = [
            'nombres' => $empleado->nombres . ' ' . $empleado->apellidos,
            'empresa' => $empleado->empresas->razon_social
        ];

        return $info;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda = AgendaEmpleado::find($id);
        $clientes = Empresa::whereNotIn('id', [1])->select('razon_social', 'id')->get();

        return view('admin.agenda.edit', compact('agenda', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgendaRequest $request, $id)
    {
        $agenda = AgendaEmpleado::find($id);

        $fecha_disponibilidad = Carbon::createFromFormat('m/d/Y', $request['fecha_disponibilidad'])->format('Y-m-d');

        $exist = AgendaEmpleado::where('fecha_disponibilidad', $fecha_disponibilidad)
            ->where('hora_inicio', $request['hora_inicio'])
            ->where('hora_fin', $request['hora_fin'])
            ->first();

        if ($request['fecha_disponibilidad'] <= Carbon::now()->format('m/d/Y')) {
            return redirect()->route('admin.agendas.edit', compact('agenda'))->with('message', 'No puedes actualizar la agenda con una fecha anterior o igual a la actual.')->with('color', 'danger');
        }

        if ($exist && (intval($id) != $exist->id)) {
            return redirect()->route('admin.agendas.edit', compact('agenda'))->with('message', 'Ya existe una agenda con ese horario.')->with('color', 'danger');
        }

        $agenda->fecha_disponibilidad = $fecha_disponibilidad;
        $agenda->hora_inicio = $request['hora_inicio'];
        $agenda->hora_fin = $request['hora_fin'];
        $agenda->empresa_id = $request['empresa_id'];
        $agenda->save();


        return redirect()->route('admin.agendas.index')->with('message', 'La agenda se ha actualizado exitosamente.')->with('color', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = AgendaEmpleado::find($id);
        $horaActual = Carbon::now();

        $cita = Cita::whereDate('fecha_fin', $agenda->fecha_disponibilidad)->where('estados', 2)->get();

        if ($agenda->fecha_disponibilidad == Carbon::now()->format('Y-m-d')) {
            return redirect()->route('admin.agendas.index')
                ->with('message', 'No puedes eliminar la agenda.')->with('color', 'danger');
        }

        if(count($cita) > 0){
            return redirect()->route('admin.agendas.index')
            ->with('message', 'No puedes eliminar la agenda, ya hay citas reservadas para ese dia.')->with('color', 'danger');
        } 

        $agenda->forceDelete();

        return redirect()->back()->with('message', 'La agenda se ha eliminado exitosamente.')->with('color', 'success');
    }

    public function cancelarCita($id)
    {
        $cita = Cita::find($id);

        if($cita->estados == 3) {
            return 0;
        }
        
        $cita->update(['estados' => 3]);

        return true;
    }
}
