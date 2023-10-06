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
                'nombre'  => 'En proceso',
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
                'nombre'  => 'Vencido',
            ],
            [
                'id'   => 7,
                'nombre'  => 'Finalizado',
            ],
        ];

        EstadoActividad::insert($estado);
    }
}
