<?php

namespace Database\Seeders;

use App\Models\GrupoEstudiante;
use Illuminate\Database\Seeder;

class HistorialSeeder extends Seeder
{
    public function run(): void
    {   //Tabla GrupoEstudiante
        $gruposBenjamin = [
            //1er Semestre
            ['grupo_id' => 1, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            ['grupo_id' => 4, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            ['grupo_id' => 6, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            ['grupo_id' => 8, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            ['grupo_id' => 10, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],

            //2do Semestre
            ['grupo_id' => 12, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            ['grupo_id' => 14, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            ['grupo_id' => 16, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            ['grupo_id' => 18, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            ['grupo_id' => 20, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],

            // //3er Semestre
            // ['grupo_id' => 12, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            // ['grupo_id' => 14, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            // ['grupo_id' => 16, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            // ['grupo_id' => 18, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            // ['grupo_id' => 20, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],

            // //4to Semestre
            // ['grupo_id' => 12, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            // ['grupo_id' => 14, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            // ['grupo_id' => 16, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            // ['grupo_id' => 18, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            // ['grupo_id' => 20, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],

            // //5to Semestre
            // ['grupo_id' => 12, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            // ['grupo_id' => 14, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            // ['grupo_id' => 16, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            // ['grupo_id' => 18, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            // ['grupo_id' => 20, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],

            // ['grupo_id' => 12, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            // ['grupo_id' => 14, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            // ['grupo_id' => 16, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            // ['grupo_id' => 18, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            // ['grupo_id' => 20, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],

            // ['grupo_id' => 12, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            // ['grupo_id' => 14, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            // ['grupo_id' => 16, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            // ['grupo_id' => 18, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            // ['grupo_id' => 20, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],



            
            
        ];
        
        foreach ($gruposBenjamin as $registro){
            GrupoEstudiante::create($registro);
        }
    }
}
