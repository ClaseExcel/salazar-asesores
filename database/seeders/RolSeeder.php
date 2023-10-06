<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'   => 1,
                'nombre'  => 'Super Administrador'
            ],
            [
                'id'   => 2,
                'nombre'  => 'Contador Senior'
            ],
            [
                'id'   => 3,
                'nombre'  => 'Contador Junior'
            ],
            [
                'id'   => 4,
                'nombre'  => 'Analista'
            ],
            [
                'id'   => 5,
                'nombre'  => 'Auditor'
            ],
            [
                'id'   => 6,
                'nombre'  => 'Cliente'
            ],
            [
                'id'   => 7,
                'nombre'  => 'Génerico'
            ],
            [
                'id'   => 8,
                'nombre'  => 'Administrador'
            ],
        ];

        Rol::insert($roles);
    }
}
