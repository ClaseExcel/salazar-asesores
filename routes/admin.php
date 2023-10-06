<?php

use App\Http\Controllers\admin\AgendaController;
use App\Http\Controllers\admin\EmpleadoClienteController;
use App\Http\Controllers\admin\EmpleadoController;
use App\Http\Controllers\admin\EmpresaController;
use App\Http\Controllers\admin\RequerimientoClienteController;
use App\Http\Controllers\admin\RequerimientoEmpleadoController;
use App\Http\Controllers\admin\CitaController;
use App\Http\Controllers\admin\ActividadClienteController;
use App\Http\Controllers\admin\InformeEmpresaController;
use App\Http\Controllers\admin\InformeUsuarioController;
use App\Http\Controllers\admin\InformeEmpresaUsuarioController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])], function () {

//empleado - admin

Route::resource('empleados', EmpleadoController::class)->names('empleados')->except('destroy');
Route::get('empleado/estado/{id}', [EmpleadoController::class, 'statusUser'])->name('update.status');

Route::resource('empresas', EmpresaController::class)->names('empresas');
Route::resource('empleado-clientes', EmpleadoClienteController::class)->names('empleado-clientes')->except('destroy');

Route::resource('agenda', AgendaController::class)->names('agendas');

Route::get('agenda/EmpleadoCliente/{id}', [AgendaController::class, 'empleadoCliente'])->name('empleadoCliente');
Route::get('agenda/citas/{id}', [AgendaController::class, 'cancelarCita'])->name('cancelarCita');

Route::resource('requerimientos-empleado', RequerimientoEmpleadoController::class)->names('requerimientos.empleado')->except('destroy');

Route::get('requerimientos-empleado/edit-seguimiento/{id}', [RequerimientoEmpleadoController::class, 'editSeguimiento'])->name('requerimientos.empleado.edit-requerimiento');
Route::put('requerimientos-empleado/update-seguimiento/{id}', [RequerimientoEmpleadoController::class, 'updateSeguimiento'])->name('requerimientos.empleado.update-seguimiento');

//cliente

Route::resource('citas', CitaController::class)->names('citas')->except('create', 'show');

Route::resource('requerimientos-cliente', RequerimientoClienteController::class)->names('requerimientos.cliente')->except('edit','update','destroy');
Route::get('requerimientos-cliente/download/{id}', [RequerimientoClienteController::class, 'download'])->name('requerimientos.cliente.download');
Route::post('requerimientos-cliente/desisitir/{id}', [RequerimientoClienteController::class, 'desistir'])->name('requerimientos.cliente.desistir');

Route::resource('actividad_cliente', ActividadClienteController::class)->except(['destroy']);

Route::get('actividad_cliente/reporte/{id}', [ActividadClienteController::class, 'reporteIndex'])->name('reporte.index');
Route::put('actividad_cliente/reporte-edit/{id}', [ActividadClienteController::class, 'reporteEdit'])->name('reporte.update');

Route::get('actividad_cliente/cliente_id/{id}', [ActividadClienteController::class, 'showEmpresa']);
Route::get('actividad_cliente/usuario_id/{id}', [ActividadClienteController::class, 'showResponsable']);

Route::get('actividad_cliente/reporte/usuario_id/{id}', [ActividadClienteController::class, 'showResponsable']);

Route::resource('informe-empresa', InformeEmpresaController::class)->names('informe-empresa')->except('create', 'store', 'show', 'edit', 'update', 'destroy');
Route::resource('informe-usuario', InformeUsuarioController::class)->names('informe-usuario')->except('create', 'store', 'show', 'edit', 'update', 'destroy');
Route::resource('informe-empresa-usuario', InformeEmpresaUsuarioController::class)->names('informe-empresa-usuario')->except('create', 'store', 'show', 'edit', 'update', 'destroy');

Route::get('informe-empresa/informe', [InformeEmpresaController::class, 'getInformeEmpresa'])->name('excel-empresa');
Route::get('informe-usuario/informe', [InformeUsuarioController::class, 'getInformeUsuario'])->name('excel-usuario');
Route::get('informe-empresa-usuario/informe', [InformeEmpresaUsuarioController::class, 'getInformeEmpresaUsuario'])->name('excel-empresa-usuario');
Route::get('informe-empresa/usuario/{id}', [InformeUsuarioController::class, 'showUsuario']);
});

Route::post('password/usuario', [EmpleadoController::class, 'updatePassword'])->name('password.usuario');