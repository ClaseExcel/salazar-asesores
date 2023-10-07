<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            [
                'id'   => 1,
                'nombre'  => 'Socio',
            ],
            [
                'id'   => 2,
                'nombre'  => 'Gerente de contabilidad',
            ],
            [
                'id'   => 3,
                'nombre'  => 'Gerente de auditoria',
            ],
            [
                'id'   => 4,
                'nombre'  => 'Coordinador contable',
            ],
            [
                'id'   => 5,
                'nombre'  => 'Coordinador de cumplimiento',
            ],
            [
                'id'   => 6,
                'nombre'  => 'Analista contable',
            ],
            [
                'id'   => 7,
                'nombre'  => 'Analista de nómina',
            ],
            [
                'id'   => 8,
                'nombre'  => 'Analista de impuestos',
            ],
            [
                'id'   => 9,
                'nombre'  => 'Analista de tesoreria',
            ],
            [
                'id'   => 10,
                'nombre'  => 'Senior de auditoria',
            ],
            [
                'id'   => 11,
                'nombre'  => 'Analista de SGSST',
            ],
            [
                'id'   => 12,
                'nombre'  => 'Abogado',
            ],
            [
                'id'   => 13,
                'nombre'  => 'Auxiliar contable',
            ],
            [
                'id'   => 14,
                'nombre'  => 'Auxiliar impuestos',
            ],
            [
                'id'   => 15,
                'nombre'  => 'Asistentes de auditoria',
            ],
            [
                'id'   => 16,
                'nombre'  => 'Auxiliares de nómina',
            ],
            [
                'id'   => 17,
                'nombre'  => 'Auxiliar de tesoreria',
            ],
            [
                'id'   => 18,
                'nombre'  => 'Cliente',
            ]
        ];

        Cargo::insert($cargos);
    }
}
