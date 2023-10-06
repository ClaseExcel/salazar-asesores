<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Models\Cargo;
use App\Models\Empresa;
use App\Models\Frecuencia;
use App\Models\Rol;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::paginate(10);

        return view('admin.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frecuencias = Frecuencia::pluck('nombre', 'id')->prepend('Selecciona una frecuencia');

        return view('admin.empresas.create', compact('frecuencias'), ['empresa' => new Empresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmpresaRequest $request)
    {

            Empresa::create([
                'NIT' => $request['NIT'],
                'razon_social' => $request['razon_social'],
                'correo_electronico' => $request['correo_electronico'],
                'numero_contacto' => $request['numero_contacto'],
                'direccion_fisica' => $request['direccion_fisica'],
                'frecuencia_id' => $request['frecuencia_id']
            ]);

            return redirect()->route('admin.empresas.index')->with('message', 'La empresa se ha creado exitosamente.')->with('color', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::find($id);

        return view('admin.empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::find($id);

        $frecuencias = Frecuencia::pluck('nombre', 'id')->prepend('Selecciona una frecuencia');

        return view('admin.empresas.edit', compact('frecuencias', 'empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresaRequest $request, $id)
    {
        $cliente = Empresa::find($id);

        $cliente->update($request->all());

        return redirect()->route('admin.empresas.index')->with('message', 'La empresa se ha actualizado exitosamente.')->with('color', 'success');
    }
}
