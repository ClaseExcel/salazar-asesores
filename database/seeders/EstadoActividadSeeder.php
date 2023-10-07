<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoActividad;

class EstadoActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = [
            [
                'id'   => 1,
                'nombre'  => 'Programado',
            ],
            [
                'id'   => 2,
                'nombre'  => 'Pendiente',
            ],
            [
                'id'   => 3,
                'nombre'  => 'Pausado',
            ],
            [
                'id'   => 4,
                'nombre'  => 'Cancelado',
            ],  
            [
                'id'   => 5,
                'nombre'  => 'Reasignar',
            ],
            [
                'id'   => 6,
                'nombre'  => 'Terminado',
            ],
            [
                'id'   => 7,
                'nombre'  => 'Cumplida',
            ],
        ];

        EstadoActividad::insert($estado);
    }
}
