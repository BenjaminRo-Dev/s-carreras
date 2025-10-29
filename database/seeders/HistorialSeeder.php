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
            ['grupo_id' => 1, 'estudiante_id' => 1, 'nota' => 55, 'creditos' => '5'],
            ['grupo_id' => 4, 'estudiante_id' => 1, 'nota' => 60, 'creditos' => '5'],
            ['grupo_id' => 6, 'estudiante_id' => 1, 'nota' => 58, 'creditos' => '5'],
            ['grupo_id' => 8, 'estudiante_id' => 1, 'nota' => 58, 'creditos' => '5'],
            ['grupo_id' => 10, 'estudiante_id' => 1, 'nota' => 72, 'creditos' => '5'],

            //2do Semestre
            ['grupo_id' => 12, 'estudiante_id' => 1, 'nota' => 51, 'creditos' => '5'],
            ['grupo_id' => 14, 'estudiante_id' => 1, 'nota' => 54, 'creditos' => '5'],
            ['grupo_id' => 16, 'estudiante_id' => 1, 'nota' => 60, 'creditos' => '5'],
            ['grupo_id' => 18, 'estudiante_id' => 1, 'nota' => 70, 'creditos' => '5'],
            ['grupo_id' => 20, 'estudiante_id' => 1, 'nota' => 71, 'creditos' => '5'],

            //3er Semestre
            ['grupo_id' => 21, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            ['grupo_id' => 23, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            ['grupo_id' => 24, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],
            ['grupo_id' => 26, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            ['grupo_id' => 27, 'estudiante_id' => 1, 'nota' => 92, 'creditos' => '5'],

            //4to Semestre
            ['grupo_id' => 28, 'estudiante_id' => 1, 'nota' => 66, 'creditos' => '5'],
            ['grupo_id' => 29, 'estudiante_id' => 1, 'nota' => 70, 'creditos' => '5'],
            ['grupo_id' => 31, 'estudiante_id' => 1, 'nota' => 79, 'creditos' => '5'],
            ['grupo_id' => 32, 'estudiante_id' => 1, 'nota' => 84, 'creditos' => '5'],
            ['grupo_id' => 34, 'estudiante_id' => 1, 'nota' => 51, 'creditos' => '5'],

            //5to Semestre
            ['grupo_id' => 36, 'estudiante_id' => 1, 'nota' => 90, 'creditos' => '5'],
            ['grupo_id' => 37, 'estudiante_id' => 1, 'nota' => 63, 'creditos' => '5'],
            ['grupo_id' => 39, 'estudiante_id' => 1, 'nota' => 75, 'creditos' => '5'],
            ['grupo_id' => 41, 'estudiante_id' => 1, 'nota' => 74, 'creditos' => '5'],
            ['grupo_id' => 43, 'estudiante_id' => 1, 'nota' => 71, 'creditos' => '5'],

            // 6to Semestre
            ['grupo_id' => 44, 'estudiante_id' => 1, 'nota' => 50, 'creditos' => '5'],
            ['grupo_id' => 45, 'estudiante_id' => 1, 'nota' => 85, 'creditos' => '5'],
            ['grupo_id' => 46, 'estudiante_id' => 1, 'nota' => 77, 'creditos' => '5'],
            ['grupo_id' => 49, 'estudiante_id' => 1, 'nota' => 88, 'creditos' => '5'],
            ['grupo_id' => 51, 'estudiante_id' => 1, 'nota' => null, 'creditos' => '5'],

            //7mo Semestre
            ['grupo_id' => 55, 'estudiante_id' => 1, 'nota' => 99, 'creditos' => '5'],
            ['grupo_id' => 57, 'estudiante_id' => 1, 'nota' => 97, 'creditos' => '5'],
            ['grupo_id' => 61, 'estudiante_id' => 1, 'nota' => 78, 'creditos' => '5'],

            //8vo Semestre
            ['grupo_id' => 64, 'estudiante_id' => 1, 'nota' => null, 'creditos' => '5'],
            ['grupo_id' => 67, 'estudiante_id' => 1, 'nota' => 80, 'creditos' => '5'],
            ['grupo_id' => 69, 'estudiante_id' => 1, 'nota' => null, 'creditos' => '5'],
            
            //9no Semestre
            
            //Electivas
            //IHC
            ['grupo_id' => 63, 'estudiante_id' => 1, 'nota' => null, 'creditos' => '5'],
            ['grupo_id' => 70, 'estudiante_id' => 1, 'nota' => null, 'creditos' => '5'],




            
            
        ];

        $gruposWilder = [
            // =================================================================
            // Datos para Wilder Choque (estudiante_id = 2) - Aprobadas/Inscritas según PDF y Seeders
            // gestion_id = 5 para todos los grupos
            // =================================================================

            // --- Nivel 1 ---
            ['grupo_id' => 1, 'estudiante_id' => 2, 'nota' => 60.0, 'creditos' => 5],  // FISICA 1 (FIS100)
            ['grupo_id' => 3, 'estudiante_id' => 2, 'nota' => 56.0, 'creditos' => 5],  // INTRODUCCIÓN A LA INFORMATICA (INF110) - Aprobada 2-2018
            ['grupo_id' => 5, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5],  // ESTRUCTURAS DISCRETAS (INF119) - Aprobada 2-2018
            ['grupo_id' => 7, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5],  // INGLÉS TECNICO 1 (LIN100) - Aprobada 2-2018
            ['grupo_id' => 9, 'estudiante_id' => 2, 'nota' => 59.0, 'creditos' => 5],  // CALCULO 1 (MAT101) - Aprobada 3-2019

            // --- Nivel 2 ---
            ['grupo_id' => 11, 'estudiante_id' => 2, 'nota' => 68.0, 'creditos' => 5], // FISICA 2 (FIS102) - Aprobada 2-2019
            ['grupo_id' => 13, 'estudiante_id' => 2, 'nota' => 75.0, 'creditos' => 5], // PROGRAMACIÓN 1 (INF120)
            ['grupo_id' => 15, 'estudiante_id' => 2, 'nota' => 71.0, 'creditos' => 5], // INGLÉS TECNICO 2 (LIN101)
            ['grupo_id' => 17, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // CALCULO 2 (MAT102)
            ['grupo_id' => 19, 'estudiante_id' => 2, 'nota' => 81.0, 'creditos' => 5], // ALGEBRA LINEAL (MAT103) - Aprobada 1-2021

            // --- Nivel 3 ---
            ['grupo_id' => 21, 'estudiante_id' => 2, 'nota' => 68.0, 'creditos' => 5], // FISICA 3 (FIS200)
            ['grupo_id' => 23, 'estudiante_id' => 2, 'nota' => 80.0, 'creditos' => 5], // ADMINISTRACIÓN (ADM100)
            ['grupo_id' => 24, 'estudiante_id' => 2, 'nota' => 51, 'creditos' => 5], // PROGRAMACIÓN 2 (INF210) - Reprobada varias veces
            ['grupo_id' => 26, 'estudiante_id' => 2, 'nota' => 55.0, 'creditos' => 5], // ARQUITECTURA DE COMPUTADORAS (INF211) - Aprobada 5-2020
            ['grupo_id' => 27, 'estudiante_id' => 2, 'nota' => 60.0, 'creditos' => 5], // ECUACIONES DIFERENCIALES (MAT207)

            // --- Nivel 4 ---
            ['grupo_id' => 28, 'estudiante_id' => 2, 'nota' => 75.0, 'creditos' => 5], // CONTABILIDAD (ADM200) - Aprobada 2-2020
            ['grupo_id' => 29, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // ESTRUCTURA DE DATOS 1 (INF220)
            ['grupo_id' => 31, 'estudiante_id' => 2, 'nota' => 69.0, 'creditos' => 5], // PROGRAMACIÓN ENSAMBLADOR (INF221)
            ['grupo_id' => 32, 'estudiante_id' => 2, 'nota' => 84.0, 'creditos' => 5], // PROBABILIDADES Y ESTADISTICAS 1 (MAT202)
            ['grupo_id' => 34, 'estudiante_id' => 2, 'nota' => 73.0, 'creditos' => 5], // METODOS NUMÉRICOS (MAT205)

            // --- Nivel 5 ---
            ['grupo_id' => 35, 'estudiante_id' => 2, 'nota' => 55.0, 'creditos' => 5], // ESTRUCTURA DE DATOS 2 (INF310) - Aprobada 1-2023
            ['grupo_id' => 37, 'estudiante_id' => 2, 'nota' => 63.0, 'creditos' => 5], // BASE DE DATOS 1 (INF312) - Aprobada 1-2023
            ['grupo_id' => 39, 'estudiante_id' => 2, 'nota' => 70.0, 'creditos' => 5], // PROGRAMACIÓN LOGICA Y FUNCIONAL (INF318)
            ['grupo_id' => 40, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // LENGUAJES FORMALES (INF319) - Aprobada 2-2024
            ['grupo_id' => 41, 'estudiante_id' => 2, 'nota' => 80.0, 'creditos' => 5], // PROBABILIDADES Y ESTADISTICAS 2 (MAT302)

            ['grupo_id' => 43, 'estudiante_id' => 2, 'nota' => null, 'creditos' => 5], // PROGRAMACIÓN GRAFICA (ELC102) - Inscrita

            // --- Nivel 6 ---
            ['grupo_id' => 44, 'estudiante_id' => 2, 'nota' => 55.0, 'creditos' => 5], // BASE DE DATOS 2 (INF322) - Aprobada 2-2023
            ['grupo_id' => 46, 'estudiante_id' => 2, 'nota' => 66.0, 'creditos' => 5], // SISTEMAS OPERATIVOS 1 (INF323) - Aprobada 5-2023
            ['grupo_id' => 48, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // COMPILADORES (INF329)
            ['grupo_id' => 49, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // SISTEMAS DE INFORMACIÓN 1 (INF342)
            ['grupo_id' => 50, 'estudiante_id' => 2, 'nota' => 54.0, 'creditos' => 5], // INVESTIGACIÓN OPERATIVA 1 (MAT329)
            ['grupo_id' => 51, 'estudiante_id' => 2, 'nota' => null, 'creditos' => 5], // TOPICOS AVANZADOS DE PROGRAMACIÓN (ELC103) - Inscrita
            // ['grupo_id' => 53, 'estudiante_id' => 2, 'nota' => ?, 'creditos' => 5], // PROGRAMACIÓN DE APLICACIONES EN TIEMPO REAL (ELC104) - No en PDF

            // --- Nivel 7 ---

            ['grupo_id' => 55, 'estudiante_id' => 2, 'nota' => 51, 'creditos' => 5], // REDES 1 (INF433) - Reprobada en PDF
            ['grupo_id' => 57, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // SISTEMAS OPERATIVOS 2 (INF413)
            ['grupo_id' => 58, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // INVESTIGACION OPERATIVA 2 (MAT419)
            ['grupo_id' => 59, 'estudiante_id' => 2, 'nota' => 80.0, 'creditos' => 5], // INTELIGENCIA ARTIFICIAL (INF418)
            ['grupo_id' => 61, 'estudiante_id' => 2, 'nota' => 60.0, 'creditos' => 5], // SISTEMAS DE INFORMACIÓN 2 (INF412)

            ['grupo_id' => 63, 'estudiante_id' => 2, 'nota' => null, 'creditos' => 5], // INTERACCIÓN HOMBRE - COMPUTADOR (ELC106) - Inscrita

            // --- Nivel 8 ---
            ['grupo_id' => 64, 'estudiante_id' => 2, 'nota' => 80.0, 'creditos' => 5], // REDES 2 (INF423) - Aprobada 3-2024
            ['grupo_id' => 65, 'estudiante_id' => 2, 'nota' => 82.0, 'creditos' => 5], // PREPARACION Y EVALUACION DE PROYECTOS (ECO449)
            ['grupo_id' => 66, 'estudiante_id' => 2, 'nota' => 52.0, 'creditos' => 5], // SISTEMAS EXPERTOS (INF428)
            ['grupo_id' => 67, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // INGENIERIA DE SOFTWARE 1 (INF422) - Aprobada 1-2025
            ['grupo_id' => 69, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // SISTEMAS DE INFORMACIÓN GEOGRÁFICA (INF442)
            ['grupo_id' => 70, 'estudiante_id' => 2, 'nota' => 54.0, 'creditos' => 5], // CRIPTOGRAFIA Y SEGURIDAD (ELC107) - Aprobada 1-2024

            // --- Nivel 9 ---
            ['grupo_id' => 72, 'estudiante_id' => 2, 'nota' => 75.0, 'creditos' => 5], // TALLER DE GRADO 1 (INF511)

            ['grupo_id' => 75, 'estudiante_id' => 2, 'nota' => null, 'creditos' => 5], // TECNOLOGÍA WEB (INF513) - Inscrita
            ['grupo_id' => 77, 'estudiante_id' => 2, 'nota' => 51.0, 'creditos' => 5], // ARQUITECTURA DEL SOFTWARE (INF552)
        ];

        $gruposTifanny = [
            // --- Nivel 1 ---
            ['grupo_id' => 1, 'estudiante_id' => 3, 'nota' => 60.0, 'creditos' => 5],  // FISICA 1 (FIS100)
            ['grupo_id' => 3, 'estudiante_id' => 3, 'nota' => 56.0, 'creditos' => 5],  // INTRODUCCIÓN A LA INFORMATICA (INF110) - Aprobada 2-2018
            ['grupo_id' => 5, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5],  // ESTRUCTURAS DISCRETAS (INF119) - Aprobada 2-2018
            ['grupo_id' => 7, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5],  // INGLÉS TECNICO 1 (LIN100) - Aprobada 2-2018
            ['grupo_id' => 9, 'estudiante_id' => 3, 'nota' => 59.0, 'creditos' => 5],  // CALCULO 1 (MAT101) - Aprobada 3-2019

            // --- Nivel 2 ---
            ['grupo_id' => 11, 'estudiante_id' => 3, 'nota' => 68.0, 'creditos' => 5], // FISICA 2 (FIS102) - Aprobada 2-2019
            ['grupo_id' => 13, 'estudiante_id' => 3, 'nota' => 75.0, 'creditos' => 5], // PROGRAMACIÓN 1 (INF120)
            ['grupo_id' => 15, 'estudiante_id' => 3, 'nota' => 71.0, 'creditos' => 5], // INGLÉS TECNICO 2 (LIN101)
            ['grupo_id' => 17, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // CALCULO 2 (MAT102)
            ['grupo_id' => 19, 'estudiante_id' => 3, 'nota' => 81.0, 'creditos' => 5], // ALGEBRA LINEAL (MAT103) - Aprobada 1-2021

            // --- Nivel 3 ---
            ['grupo_id' => 21, 'estudiante_id' => 3, 'nota' => 68.0, 'creditos' => 5], // FISICA 3 (FIS200)
            ['grupo_id' => 23, 'estudiante_id' => 3, 'nota' => 80.0, 'creditos' => 5], // ADMINISTRACIÓN (ADM100)
            ['grupo_id' => 24, 'estudiante_id' => 3, 'nota' => 51, 'creditos' => 5], // PROGRAMACIÓN 2 (INF210) - Reprobada varias veces
            ['grupo_id' => 26, 'estudiante_id' => 3, 'nota' => 55.0, 'creditos' => 5], // ARQUITECTURA DE COMPUTADORAS (INF211) - Aprobada 5-2020
            ['grupo_id' => 27, 'estudiante_id' => 3, 'nota' => 60.0, 'creditos' => 5], // ECUACIONES DIFERENCIALES (MAT207)

            // --- Nivel 4 ---
            ['grupo_id' => 28, 'estudiante_id' => 3, 'nota' => 75.0, 'creditos' => 5], // CONTABILIDAD (ADM200) - Aprobada 2-2020
            ['grupo_id' => 29, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // ESTRUCTURA DE DATOS 1 (INF220)
            ['grupo_id' => 31, 'estudiante_id' => 3, 'nota' => 69.0, 'creditos' => 5], // PROGRAMACIÓN ENSAMBLADOR (INF221)
            ['grupo_id' => 32, 'estudiante_id' => 3, 'nota' => 84.0, 'creditos' => 5], // PROBABILIDADES Y ESTADISTICAS 1 (MAT202)
            ['grupo_id' => 34, 'estudiante_id' => 3, 'nota' => 73.0, 'creditos' => 5], // METODOS NUMÉRICOS (MAT205)

            // --- Nivel 5 ---
            ['grupo_id' => 35, 'estudiante_id' => 3, 'nota' => 55.0, 'creditos' => 5], // ESTRUCTURA DE DATOS 2 (INF310) - Aprobada 1-2023
            ['grupo_id' => 37, 'estudiante_id' => 3, 'nota' => 63.0, 'creditos' => 5], // BASE DE DATOS 1 (INF312) - Aprobada 1-2023
            ['grupo_id' => 39, 'estudiante_id' => 3, 'nota' => 70.0, 'creditos' => 5], // PROGRAMACIÓN LOGICA Y FUNCIONAL (INF318)
            ['grupo_id' => 40, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // LENGUAJES FORMALES (INF319) - Aprobada 2-2024
            ['grupo_id' => 41, 'estudiante_id' => 3, 'nota' => 80.0, 'creditos' => 5], // PROBABILIDADES Y ESTADISTICAS 2 (MAT302)

            ['grupo_id' => 43, 'estudiante_id' => 3, 'nota' => null, 'creditos' => 5], // PROGRAMACIÓN GRAFICA (ELC102) - Inscrita

            // --- Nivel 6 ---
            ['grupo_id' => 44, 'estudiante_id' => 3, 'nota' => 55.0, 'creditos' => 5], // BASE DE DATOS 2 (INF322) - Aprobada 2-2023
            ['grupo_id' => 46, 'estudiante_id' => 3, 'nota' => 66.0, 'creditos' => 5], // SISTEMAS OPERATIVOS 1 (INF323) - Aprobada 5-2023
            ['grupo_id' => 48, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // COMPILADORES (INF329)
            ['grupo_id' => 49, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // SISTEMAS DE INFORMACIÓN 1 (INF342)
            ['grupo_id' => 50, 'estudiante_id' => 3, 'nota' => 54.0, 'creditos' => 5], // INVESTIGACIÓN OPERATIVA 1 (MAT329)
            ['grupo_id' => 51, 'estudiante_id' => 3, 'nota' => null, 'creditos' => 5], // TOPICOS AVANZADOS DE PROGRAMACIÓN (ELC103) - Inscrita

            // --- Nivel 7 ---

            ['grupo_id' => 55, 'estudiante_id' => 3, 'nota' => 51, 'creditos' => 5], // REDES 1 (INF433) - Reprobada en PDF
            ['grupo_id' => 57, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // SISTEMAS OPERATIVOS 2 (INF413)
            ['grupo_id' => 58, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // INVESTIGACION OPERATIVA 2 (MAT419)
            ['grupo_id' => 59, 'estudiante_id' => 3, 'nota' => 80.0, 'creditos' => 5], // INTELIGENCIA ARTIFICIAL (INF418)
            ['grupo_id' => 61, 'estudiante_id' => 3, 'nota' => 60.0, 'creditos' => 5], // SISTEMAS DE INFORMACIÓN 2 (INF412)

            ['grupo_id' => 63, 'estudiante_id' => 3, 'nota' => null, 'creditos' => 5], // INTERACCIÓN HOMBRE - COMPUTADOR (ELC106) - Inscrita

            // --- Nivel 8 ---
            ['grupo_id' => 64, 'estudiante_id' => 3, 'nota' => 80.0, 'creditos' => 5], // REDES 2 (INF423) - Aprobada 3-2024
            ['grupo_id' => 65, 'estudiante_id' => 3, 'nota' => 82.0, 'creditos' => 5], // PREPARACION Y EVALUACION DE PROYECTOS (ECO449)
            ['grupo_id' => 66, 'estudiante_id' => 3, 'nota' => 52.0, 'creditos' => 5], // SISTEMAS EXPERTOS (INF428)
            ['grupo_id' => 67, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // INGENIERIA DE SOFTWARE 1 (INF422) - Aprobada 1-2025
            ['grupo_id' => 69, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // SISTEMAS DE INFORMACIÓN GEOGRÁFICA (INF442)
            ['grupo_id' => 70, 'estudiante_id' => 3, 'nota' => 54.0, 'creditos' => 5], // CRIPTOGRAFIA Y SEGURIDAD (ELC107) - Aprobada 1-2024

            // --- Nivel 9 ---
            ['grupo_id' => 72, 'estudiante_id' => 3, 'nota' => 75.0, 'creditos' => 5], // TALLER DE GRADO 1 (INF511)

            ['grupo_id' => 75, 'estudiante_id' => 3, 'nota' => null, 'creditos' => 5], // TECNOLOGÍA WEB (INF513) - Inscrita
            ['grupo_id' => 77, 'estudiante_id' => 3, 'nota' => 51.0, 'creditos' => 5], // ARQUITECTURA DEL SOFTWARE (INF552)

        ];
        
        foreach ($gruposBenjamin as $registro){
            GrupoEstudiante::create($registro);
        }

        foreach ($gruposWilder as $registro){
            GrupoEstudiante::create($registro);
        }

        foreach ($gruposTifanny as $registro){
            GrupoEstudiante::create($registro);
        }
    }
}
