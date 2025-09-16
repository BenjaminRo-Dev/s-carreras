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
            ['registro' => '200000000', 'nombre' => 'Benjamin Romero', 'email' => 'benjamin.romero@estudiante.uagrm.bo', 'telefono' => '78123456', 'plan_estudio_id' => 1],
            ['registro' => '202300001', 'nombre' => 'Juan Pérez Mamani', 'email' => 'juan.perez@estudiante.uagrm.bo', 'telefono' => '78123456', 'plan_estudio_id' => 1],
            ['registro' => '202300002', 'nombre' => 'María García Condori', 'email' => 'maria.garcia@estudiante.uagrm.bo', 'telefono' => '78234567', 'plan_estudio_id' => 1],
            ['registro' => '202300003', 'nombre' => 'Carlos Quispe Flores', 'email' => 'carlos.quispe@estudiante.uagrm.bo', 'telefono' => '78345678', 'plan_estudio_id' => 1],
            ['registro' => '202300004', 'nombre' => 'Ana Choque Mamani', 'email' => 'ana.choque@estudiante.uagrm.bo', 'telefono' => '78456789', 'plan_estudio_id' => 1],
            ['registro' => '202300005', 'nombre' => 'Luis Vargas Cruz', 'email' => 'luis.vargas@estudiante.uagrm.bo', 'telefono' => '78567890', 'plan_estudio_id' => 1],
        ];

        foreach ($estudiantes as $estudiante) {
             // Crear usuario
            $user = User::create([
                'name' => $estudiante['nombre'],
                'email' => $estudiante['email'],
                'password' => Hash::make($estudiante['registro']), // Contraseña = número de registro
            ]);

            // Crear estudiante asociado al usuario
            Estudiante::create([
                'registro' => $estudiante['registro'],
                'nombre' => $estudiante['nombre'],
                'email' => $estudiante['email'],
                'telefono' => $estudiante['telefono'],
                'plan_estudio_id' => $estudiante['plan_estudio_id'],
                'user_id' => $user->id,
            ]);
        }
    }
}
