<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [
                'id'   => 1,
                'cedula' => '11111',
                'nombres'  => 'Super Administrador',
                'apellidos' => 'Administrador',
                'email' => 'superadmin@salazarasesores.com',
                'cargo_id' => 1,
                'rol_id' => 1,
                'password' => Hash::make('1234'),
            ],
            // [
                // 'id'   => 2,
                // 'cedula' => '543567874',
                // 'nombres'  => 'Super Administrador',
                // 'apellidos' => 'Andrés Torres',
                // 'email' => 'admin@admin.com',
                // 'cargo_id' => 1,
                // 'rol_id' => 1,
                // 'password' => Hash::make('Tributo2023#'),
                // 'password' => Hash::make('Cde2023?'),
            // ],
        ];

        User::insert($admin);
    }
}
