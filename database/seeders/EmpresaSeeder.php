<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $empresa = [
            [
                'NIT' => '9008261403',
                'razon_social' => 'Salazar Asesores',
                'numero_contacto' => '321 648 66 30',
                'correo_electronico' => 'info@salazarasesores.com.co',
                'direccion_fisica' => 'Calle 10B # 36-32, Of. 501, 502, 601 Ed.
                El Ático 2',
                'frecuencia_id' => 1
            ],
        ];

        Empresa::insert($empresa);
    }
}
