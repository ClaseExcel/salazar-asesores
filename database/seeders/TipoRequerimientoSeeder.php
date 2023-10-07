<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoRequerimiento;

class TipoRequerimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_requerimientos = [
            [
                'id'   => 1,
                'nombre'  => 'Servicios de Nómina',
            ],
            [
                'id'   => 2,
                'nombre'  => 'Servicios integrales de Contabilidad',
            ],
            [
                'id'   => 3,
                'nombre'  => 'Servicios de auditoría',
            ],
            [
                'id'   => 4,
                'nombre'  => 'Impuestos y certificados',
            ],  
        ];

        TipoRequerimiento::insert($tipo_requerimientos);
    }
}
