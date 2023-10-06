<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmpleadoClienteRequest;
use App\Http\Requests\UpdateEmpleadoClienteRequest;
use App\Mail\restablecerContraseña;
use App\Models\Cargo;
use App\Models\EmpleadoCliente;
use App\Models\Empresa;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class EmpleadoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoClientes = EmpleadoCliente::paginate(10);

        return view('admin.empleado-clientes.index', compact('empleadoClientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Rol::whereIn('nombre', ['Cliente', 'Génerico'])->select('nombre', 'id')->get();
        $cargo = Cargo::select('id')->where('nombre', 'Cliente')->first();
        $empresas = Empresa::whereNotIn('id', [1])->get();

        return view('admin.empleado-clientes.create', compact('roles', 'cargo', 'empresas'), ['empleado_cliente' => new EmpleadoCliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmpleadoClienteRequest $request)
    {
        $lastUser = User::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'cargo_id' => $request['cargo_id'],
            'rol_id' => $request['rol_id'],
        ]);

        EmpleadoCliente::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'correo_electronico' => $request['email'],
            'numero_contacto' => $request['numero_contacto'],
            'correos_secundarios' => $request['correos_secundarios'],
            'empresa_id' => $request['empresa_id'],
            'user_id' => $lastUser->id
        ]);

        $token = Password::createToken($lastUser);
        Mail::to($request['email'])->send(new restablecerContraseña($request['email'], $request['password'], $token));

        return redirect()->route('admin.empleado-clientes.index')->with('message', 'El usuario se ha creado exitosamente.')->with('color', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado_cliente = EmpleadoCliente::find($id);

        return view('admin.empleado-clientes.show', compact('empleado_cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $empleado_cliente = EmpleadoCliente::find($id);
        $empleado_rol = User::where('email', $empleado_cliente->correo_electronico)->first();

        $roles = Rol::whereIn('nombre', ['Cliente', 'Génerico'])->select('nombre', 'id')->get();
        $cargo = Cargo::select('id')->where('nombre', 'Cliente')->first();
        $empresas = Empresa::whereNotIn('id', [1])->get();

        return view('admin.empleado-clientes.edit', compact('empleado_cliente', 'roles', 'cargo', 'empresas', 'empleado_rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpleadoClienteRequest $request, $id)
    {
        $empleado_cliente = EmpleadoCliente::find($id);
        $user = User::where('email', $empleado_cliente->correo_electronico)->first();


        $empleado_cliente->update([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'correo_electronico' => $request['email'],
            'correos_secundarios' => $request['correos_secundarios'],
            'empresa_id' => $request['empresa_id']
            ]);
        
        $user->update([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'email' => $request['email']
            ]);

        return redirect()->route('admin.empleado-clientes.index')->with('message', 'El usuario se ha actualizado exitosamente.')->with('color', 'success');
    }
}
