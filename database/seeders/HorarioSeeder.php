<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        $horarios = [
            // FIS100-A: Lunes y Miércoles módulos 1-2
            ['dia' => 'Lunes', 'hora_inicio' => '07:00', 'hora_fin' => '10:00', 'grupo_id' => 1, 'aula_id' => 1, 'modulo_id' => 1],
            ['dia' => 'Miércoles', 'hora_inicio' => '07:00', 'hora_fin' => '10:00', 'grupo_id' => 1, 'aula_id' => 1, 'modulo_id' => 1],
            ['dia' => 'Viernes', 'hora_inicio' => '07:00', 'hora_fin' => '10:00', 'grupo_id' => 1, 'aula_id' => 1, 'modulo_id' => 1],

            // INF110-A: Martes y Jueves módulos 3-4
            ['dia' => 'Martes', 'hora_inicio' => '10:15', 'hora_fin' => '13:15', 'grupo_id' => 2, 'aula_id' => 5, 'modulo_id' => 3],
            ['dia' => 'Jueves', 'hora_inicio' => '10:15', 'hora_fin' => '13:15', 'grupo_id' => 2, 'aula_id' => 5, 'modulo_id' => 3],

            // INF119-A: Lunes y Viernes módulos 5-6
            ['dia' => 'Lunes', 'hora_inicio' => '14:30', 'hora_fin' => '17:30', 'grupo_id' => 3, 'aula_id' => 2, 'modulo_id' => 5],
            ['dia' => 'Miércoles', 'hora_inicio' => '07:00', 'hora_fin' => '10:00', 'grupo_id' => 3, 'aula_id' => 1, 'modulo_id' => 1],
            // ['dia' => 'Viernes', 'hora_inicio' => '14:30', 'hora_fin' => '17:30', 'grupo_id' => 3, 'aula_id' => 2, 'modulo_id' => 5],
            ['dia' => 'Viernes', 'hora_inicio' => '07:00', 'hora_fin' => '10:00', 'grupo_id' => 3, 'aula_id' => 12, 'modulo_id' => 1],

            // INF120-A: Martes y Jueves módulos 1-2
            ['dia' => 'Martes', 'hora_inicio' => '07:00', 'hora_fin' => '10:00', 'grupo_id' => 7, 'aula_id' => 6, 'modulo_id' => 1],
            ['dia' => 'Jueves', 'hora_inicio' => '07:00', 'hora_fin' => '10:00', 'grupo_id' => 7, 'aula_id' => 6, 'modulo_id' => 1],
        ];

        foreach ($horarios as $horario) {
            Horario::create($horario);
        }
    }
}
