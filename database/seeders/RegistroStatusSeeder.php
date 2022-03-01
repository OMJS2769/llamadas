<?php

namespace Database\Seeders;

use App\Models\Registro;
use Illuminate\Database\Seeder;
use App\Models\RegistroStatus;

class RegistroStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegistroStatus::updateOrCreate(['status' => 'Pendiente']);
        RegistroStatus::updateOrCreate(['status' => 'Efectivo']);
        RegistroStatus::updateOrCreate(['status' => 'No efectivo']);
        RegistroStatus::updateOrCreate(['status' => 'No existe']);
        RegistroStatus::updateOrCreate(['status' => 'Número ocupado']);
    }
}
