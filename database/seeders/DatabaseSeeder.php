<?php

namespace Database\Seeders;

use App\Models\Frecuencia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RolSeeder::class,
            CargoSeeder::class,
            UserSeeder::class,
            FrecuenciaSeeder::class,
            EmpresaSeeder::class,
            ModalidadSeeder::class,
            TipoRequerimientoSeeder::class,
            EstadoRequerimientoSeeder::class,
            ActividadSeeder::class,
            ResponsableSeeder::class,  
            EstadoActividadSeeder::class,
        ]);
    }
}
