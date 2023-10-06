<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requerimiento;
use App\Models\User;
use App\Models\SeguimientoRequerimiento;
use App\Models\EmpleadoCliente;
use App\Models\Documento;
use App\Models\TipoRequerimiento;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateRequerimientoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use ZipArchive;
use Illuminate\Support\Facades\Mail;
use App\Mail\envioRequerimiento;


class RequerimientoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario_cliente = EmpleadoCliente::where('user_id', Auth::user()->id)->first();
        $requerimientos = Requerimiento::where('empleado_cliente_id', $usuario_cliente->id)->get();

        $requerimiento_cliente = [];

        foreach ($requerimientos as  $requerimiento) {
            $seguimiento_requerimiento = SeguimientoRequerimiento::where('requerimiento_id', $requerimiento->id)->first();

            $requerimiento_cliente[] = [
                'id' => $requerimiento->id,
                'consecutivo' => $requerimiento->consecutivo,
                'descripcion' => $requerimiento->descripcion,
                'tipo_requerimiento' => $requerimiento->tipo_requerimientos->nombre,
                'estado' => $seguimiento_requerimiento->estado_requerimiento_id
            ];          
        }

        return view('admin.requerimiento-cliente.index', compact('requerimiento_cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_requerimientos = TipoRequerimiento::pluck('nombre', 'id')->prepend('Selecciona un tipo de requerimiento');

        return view('admin.requerimiento-cliente.create', compact('tipo_requerimientos'), ['requerimiento' => New Requerimiento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequerimientoRequest $request)
    {

        $usuario_cliente = EmpleadoCliente::where('user_id', Auth::user()->id)->first();

        $requerimiento = Requerimiento::create([
            'tipo_requerimiento_id' => $request['tipo_requerimiento_id'],
            'descripcion' => $request['descripcion'],
            'empleado_cliente_id' => $usuario_cliente->id,
            'consecutivo' => Requerimiento::generarCodigo()
        ]);

        SeguimientoRequerimiento::create([
            'requerimiento_id' => $requerimiento->id,
            'estado_requerimiento_id' => 1,
        ]);


        if($request->file('documentos')){
            $url = storage_path('requerimientos');
            $foldername = uniqid();
       
            if(!File::exists($url)){
              File::makeDirectory($url);
            } 
    
           foreach ($request->file('documentos') as $archivo) {
                $archivo->move($url . '/' . $foldername, $archivo->getClientOriginalName());
                $urlPathDocument = 'requerimientos/' . $foldername . '/' . $archivo->getClientOriginalName();

                Documento::create([
                    'documentos' => $urlPathDocument,
                    'requerimiento_id' => $requerimiento->id,
                ]);
            }
        } 

        $contador_senior = User::where('rol_id', 2)->get();

        foreach ($contador_senior as  $contador) {
            Mail::to($contador->email)->send(new envioRequerimiento($requerimiento->consecutivo, $requerimiento->tipo_requerimientos->nombre));
        }
      
        return redirect()->back()->with('message', 'Requerimiento solicitado exitosamente.')->with('color', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requerimiento = Requerimiento::find($id);
        $seguimiento_requerimiento = SeguimientoRequerimiento::where('requerimiento_id', $id)->first();
        $documento = Documento::where('requerimiento_id', $id)->first();

        return view('admin.requerimiento-cliente.show', compact('requerimiento', 'seguimiento_requerimiento', 'documento'));
    }

    public function download($id)
    {
        $documento = Documento::where('requerimiento_id', $id)->first();

        $carpeta = storage_path(File::dirname($documento->documentos)); // Ruta a la carpeta que quieres comprimir
        $archivoZip = storage_path('requerimientos/'. uniqid() . '.zip'); // Ruta donde se almacenará el archivo ZIP

        $zip = new ZipArchive();
        if ($zip->open($archivoZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $archivos = File::files($carpeta);

            foreach ($archivos as $archivo) {
                $nombreArchivo = pathinfo($archivo, PATHINFO_BASENAME);
                $zip->addFile($archivo, $nombreArchivo);
            }

            $zip->close();
            
            return response()->download($archivoZip)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('message', 'Error al crear el archivo ZIP.')->with('color', 'danger');
    }

    public function desistir($id){

        $requerimiento = SeguimientoRequerimiento::where('requerimiento_id', $id)->first();

        $requerimiento->update([
            'estado_requerimiento_id' => 6
        ]);

        return true;
    }

}
