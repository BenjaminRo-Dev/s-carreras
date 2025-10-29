<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {

        // FIS100-A: Lunes y Miércoles módulos 1-2
        $horarios = [
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
        ];

        foreach ($horarios as $horario) {
            Horario::create($horario);
        }



        // Días de la semana
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        
        // Bloques horarios disponibles
        $bloques = [
            ['hora_inicio' => '07:00', 'hora_fin' => '10:00'],
            ['hora_inicio' => '10:15', 'hora_fin' => '13:15'],
            ['hora_inicio' => '14:30', 'hora_fin' => '17:30'],
            ['hora_inicio' => '18:00', 'hora_fin' => '21:00'],
        ];

        // Generar horarios para grupos del 1 al 78
        for ($grupo_id = 1; $grupo_id <= 78; $grupo_id++) {
            // Cada grupo tendrá entre 2 y 3 sesiones de clase por semana
            $numSesiones = rand(2, 3);
            $diasUsados = [];
            
            for ($i = 0; $i < $numSesiones; $i++) {
                // Seleccionar un día aleatorio que no se haya usado
                do {
                    $dia = $dias[array_rand($dias)];
                } while (in_array($dia, $diasUsados) && count($diasUsados) < count($dias));
                
                $diasUsados[] = $dia;
                
                // Seleccionar bloque horario aleatorio
                $bloque = $bloques[array_rand($bloques)];
                
                // Seleccionar aula aleatoria (hay 30 aulas en total)
                $aula_id = rand(1, 30);
                
                // Seleccionar módulo aleatorio (hay 5 módulos)
                $modulo_id = rand(1, 5);
                
                Horario::create([
                    'dia' => $dia,
                    'hora_inicio' => $bloque['hora_inicio'],
                    'hora_fin' => $bloque['hora_fin'],
                    'grupo_id' => $grupo_id,
                    'aula_id' => $aula_id,
                    'modulo_id' => $modulo_id,
                ]);
            }
        }
    }
}
