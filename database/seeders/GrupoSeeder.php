<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    public function run(): void
    {
        $grupos = [
            // Nivel 1 - FISICA 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 1, 'docente_id' => 1, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 1, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 1 - INTRODUCCIÓN A LA INFORMATICA
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 2, 'docente_id' => 3, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 2, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 1 - ESTRUCTURAS DISCRETAS
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 3, 'docente_id' => 5, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 3, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 1 - INGLÉS TECNICO 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 4, 'docente_id' => 2, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 4, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 1 - CALCULO 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 5, 'docente_id' => 4, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 5, 'docente_id' => 5, 'gestion_id' => 5],

            // Nivel 2 - FISICA 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 6, 'docente_id' => 1, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 6, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 2 - PROGRAMACIÓN 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 7, 'docente_id' => 3, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 7, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 2 - INGLÉS TECNICO 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 8, 'docente_id' => 5, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 8, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 2 - CALCULO 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 9, 'docente_id' => 2, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 9, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 2 - ALGEBRA LINEAL
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 10, 'docente_id' => 4, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 10, 'docente_id' => 5, 'gestion_id' => 5],

            // Nivel 3 - FISICA 3
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 11, 'docente_id' => 1, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 11, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 3 - ADMINISTRACIÓN
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 12, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 3 - PROGRAMACIÓN 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 13, 'docente_id' => 4, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 13, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 3 - ARQUITECTURA DE COMPUTADORAS
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 14, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 3 - ECUACIONES DIFERENCIALES
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 15, 'docente_id' => 2, 'gestion_id' => 5],

            // Nivel 4 - CONTABILIDAD
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 16, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 4 - ESTRUCTURA DE DATOS 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 17, 'docente_id' => 4, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 17, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 4 - PROGRAMACIÓN ENSAMBLADOR
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 18, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 4 - PROBABILIDADES Y ESTADISTICAS 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 19, 'docente_id' => 2, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 19, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 4 - METODOS NUMÉRICOS
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 20, 'docente_id' => 4, 'gestion_id' => 5],

            // Nivel 5 - ESTRUCTURA DE DATOS 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 21, 'docente_id' => 5, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 21, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 5 - BASE DE DATOS 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 22, 'docente_id' => 2, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 22, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 5 - PROGRAMACIÓN LOGICA Y FUNCIONAL
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 23, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 5 - LENGUAJES FORMALES
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 24, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 5 - PROBABILIDADES Y ESTADISTICAS 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 25, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 5 - MODELACIÓN Y SIMULACIÓN DE SISTEMAS
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 26, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 5 - PROGRAMACIÓN GRAFICA
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 27, 'docente_id' => 3, 'gestion_id' => 5],

            // Nivel 6 - BASE DE DATOS 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 28, 'docente_id' => 4, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 28, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 6 - SISTEMAS OPERATIVOS 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 29, 'docente_id' => 1, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 29, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 6 - COMPILADORES
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 30, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 6 - SISTEMAS DE INFORMACIÓN 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 31, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 6 - INVESTIGACIÓN OPERATIVA 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 32, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 6 - TOPICOS AVANZADOS DE PROGRAMACIÓN
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 33, 'docente_id' => 1, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 33, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 6 - PROGRAMACIÓN DE APLICACIONES EN TIEMPO REAL
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 34, 'docente_id' => 3, 'gestion_id' => 5],

            // Nivel 7 - MODALIDAD DE TITULACION A NIVEL TECNICO SUPERIOR
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 35, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 7 - REDES 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 36, 'docente_id' => 5, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 36, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 7 - SISTEMAS OPERATIVOS 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 37, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 7 - INVESTIGACION OPERATIVA 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 38, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 7 - INTELIGENCIA ARTIFICIAL
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 39, 'docente_id' => 4, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 39, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 7 - SISTEMAS DE INFORMACIÓN 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 40, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 7 - SISTEMAS DISTRIBUIDOS
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 41, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 7 - INTERACCIÓN HOMBRE - COMPUTADOR
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 42, 'docente_id' => 3, 'gestion_id' => 5],

            // Nivel 8 - REDES 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 43, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 8 - PREPARACION Y EVALUACION DE PROYECTOS
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 44, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 8 - SISTEMAS EXPERTOS
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 45, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 8 - INGENIERIA DE SOFTWARE 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 46, 'docente_id' => 2, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 46, 'docente_id' => 3, 'gestion_id' => 5],
            
            // Nivel 8 - SISTEMAS DE INFORMACIÓN GEOGRÁFICA
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 47, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 8 - CRIPTOGRAFIA Y SEGURIDAD
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 48, 'docente_id' => 5, 'gestion_id' => 5],
            
            // Nivel 8 - CONTROL Y AUTOMATIZACIÓN
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 49, 'docente_id' => 1, 'gestion_id' => 5],

            // Nivel 9 - TALLER DE GRADO 1
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 50, 'docente_id' => 2, 'gestion_id' => 5],
            
            // Nivel 9 - INGENIERIA DE SOFTWARE 2
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 51, 'docente_id' => 3, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 51, 'docente_id' => 4, 'gestion_id' => 5],
            
            // Nivel 9 - TECNOLOGÍA WEB
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 52, 'docente_id' => 5, 'gestion_id' => 5],
            ['sigla' => 'SB', 'cupo' => 40, 'materia_id' => 52, 'docente_id' => 1, 'gestion_id' => 5],
            
            // Nivel 9 - ARQUITECTURA DEL SOFTWARE
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 53, 'docente_id' => 2, 'gestion_id' => 5],

            // Nivel 10 - MODALIDAD DE TITULACIÓN LICENCIATURA
            ['sigla' => 'SA', 'cupo' => 40, 'materia_id' => 54, 'docente_id' => 3, 'gestion_id' => 5],
        ];

        foreach ($grupos as $grupo) {
            Grupo::create($grupo);
        }
    }
}
