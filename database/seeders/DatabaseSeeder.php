<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::factory(15)->create();
        Paciente::factory(1200)->create();
    }
}
