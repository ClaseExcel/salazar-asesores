<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ActividadEmpresaUsuarioExport implements FromView,ShouldAutoSize

{
    public $cantidadActividadesEstado, $cantidadActividades;

    function __construct($cantidadActividadesEstado, $cantidadActividades)
    {
        $this->cantidadActividadesEstado = $cantidadActividadesEstado;
        $this->cantidadActividades = $cantidadActividades;
    }

    public function view(): View
    {
            return view('admin.informes.excel.excel-actividad-empresa-usuario', [
                'cantidadActividadesEstado' => $this->cantidadActividadesEstado, 
                'cantidadActividades' => $this->cantidadActividades, 
        ]);
    }
}
