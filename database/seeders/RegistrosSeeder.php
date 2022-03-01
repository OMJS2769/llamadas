<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registro;

class RegistrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Registro::updateOrCreate(['nombre' => 'Mauricio Soriano', 'telefono' => '5631146538']);
        Registro::updateOrCreate(['nombre' => 'Ulises', 'telefono' => '5529023868']);
        Registro::updateOrCreate(['nombre' => 'Ricardo', 'telefono' => '5565135875']);
    }
}
