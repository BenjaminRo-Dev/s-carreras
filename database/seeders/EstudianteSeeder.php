<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $estudiantes = [
            ['registro' => '200000000', 'codigo' => '12345', 'nombre' => 'Benjamin Romero', 'email' => 'benjamin.romero@estudiante.uagrm.bo', 'telefono' => '78123456', 'plan_estudio_id' => 1],
            ['registro' => '202300001', 'codigo' => '12345', 'nombre' => 'Wilder Choque', 'email' => 'wilder.choque@estudiante.uagrm.bo', 'telefono' => '78123456', 'plan_estudio_id' => 1],
            ['registro' => '202300002', 'codigo' => '12345', 'nombre' => 'Tifanny Pariona', 'email' => 'tifanny.pariona@estudiante.uagrm.bo', 'telefono' => '78234567', 'plan_estudio_id' => 1],
            ['registro' => '202300003', 'codigo' => '12345', 'nombre' => 'Juan Perez', 'email' => 'juan.perez@estudiante.uagrm.bo', 'telefono' => '78345678', 'plan_estudio_id' => 1],
            ['registro' => '202300004', 'codigo' => '12345', 'nombre' => 'Luis Vega', 'email' => 'luis.vega@estudiante.uagrm.bo', 'telefono' => '78456789', 'plan_estudio_id' => 1],
            ['registro' => '202300005', 'codigo' => '12345', 'nombre' => 'Fernando Herrera', 'email' => 'fernando.herrera@estudiante.uagrm.bo', 'telefono' => '78567890', 'plan_estudio_id' => 1],
        ];

        foreach ($estudiantes as $estudiante) {
            // Crear estudiante asociado al usuario
            Estudiante::create([
                'registro' => $estudiante['registro'],
                'nombre' => $estudiante['nombre'],
                'email' => $estudiante['email'],
                'telefono' => $estudiante['telefono'],
                'plan_estudio_id' => $estudiante['plan_estudio_id'],
            ]);
        }
    }
}
