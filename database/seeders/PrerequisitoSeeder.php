<?php

namespace Database\Seeders;

use App\Models\Prerequisito;
use Illuminate\Database\Seeder;

class PrerequisitoSeeder extends Seeder
{
    public function run(): void
    {
        // PRIMER SEMESTRE: Sin prerequisitos (IDs 1-5)
        // FIS100, INF110, INF119, LIN100, MAT101

        // SEGUNDO SEMESTRE (IDs 6-10)
        Prerequisito::create(['materia_id' => 6, 'prerequisito_id' => 1]); // FIS102 (FISICA 2) -> FIS100
        Prerequisito::create(['materia_id' => 7, 'prerequisito_id' => 2]); // INF120 (PROGRAMACIÓN 1) -> INF110
        Prerequisito::create(['materia_id' => 8, 'prerequisito_id' => 4]); // LIN101 (INGLÉS TECNICO 2) -> LIN100
        Prerequisito::create(['materia_id' => 9, 'prerequisito_id' => 5]); // MAT102 (CALCULO 2) -> MAT101
        Prerequisito::create(['materia_id' => 10, 'prerequisito_id' => 3]); // MAT103 (ALGEBRA LINEAL) -> INF119

        // TERCER SEMESTRE (IDs 11-15)
        Prerequisito::create(['materia_id' => 11, 'prerequisito_id' => 6]); // FIS200 (FISICA 3) -> FIS102
        // ADM100 (ADMINISTRACIÓN) - Sin prerequisitos
        Prerequisito::create(['materia_id' => 13, 'prerequisito_id' => 7]); // INF210 (PROGRAMACIÓN 2) -> INF120
        Prerequisito::create(['materia_id' => 13, 'prerequisito_id' => 10]); // INF210 (PROGRAMACIÓN 2) -> MAT103
        Prerequisito::create(['materia_id' => 14, 'prerequisito_id' => 7]); // INF211 (ARQUITECTURA DE COMPUTADORAS) -> INF120
        Prerequisito::create(['materia_id' => 14, 'prerequisito_id' => 6]); // INF211 (ARQUITECTURA DE COMPUTADORAS) -> FIS102
        Prerequisito::create(['materia_id' => 15, 'prerequisito_id' => 9]); // MAT207 (ECUACIONES DIFERENCIALES) -> MAT102

        // CUARTO SEMESTRE (IDs 16-20)
        Prerequisito::create(['materia_id' => 16, 'prerequisito_id' => 12]); // ADM200 (CONTABILIDAD) -> ADM100
        Prerequisito::create(['materia_id' => 17, 'prerequisito_id' => 13]); // INF220 (ESTRUCTURA DE DATOS 1) -> INF210
        Prerequisito::create(['materia_id' => 17, 'prerequisito_id' => 5]); // INF220 (ESTRUCTURA DE DATOS 1) -> MAT101
        Prerequisito::create(['materia_id' => 18, 'prerequisito_id' => 14]); // INF221 (PROGRAMACIÓN ENSAMBLADOR) -> INF211
        Prerequisito::create(['materia_id' => 19, 'prerequisito_id' => 9]); // MAT202 (PROBABILIDADES Y ESTADISTICAS 1) -> MAT102
        Prerequisito::create(['materia_id' => 20, 'prerequisito_id' => 15]); // MAT205 (METODOS NUMÉRICOS) -> MAT207

        // QUINTO SEMESTRE (IDs 21-27)
        Prerequisito::create(['materia_id' => 21, 'prerequisito_id' => 17]); // INF310 (ESTRUCTURA DE DATOS 2) -> INF220
        Prerequisito::create(['materia_id' => 22, 'prerequisito_id' => 17]); // INF312 (BASE DE DATOS 1) -> INF220
        Prerequisito::create(['materia_id' => 23, 'prerequisito_id' => 17]); // INF318 (PROGRAMACIÓN LOGICA Y FUNCIONAL) -> INF220
        Prerequisito::create(['materia_id' => 24, 'prerequisito_id' => 17]); // INF319 (LENGUAJES FORMALES) -> INF220
        Prerequisito::create(['materia_id' => 25, 'prerequisito_id' => 19]); // MAT302 (PROBABILIDADES Y ESTADISTICAS 2) -> MAT202
        // ELC101 (MODELACIÓN Y SIMULACIÓN DE SISTEMAS) - ELECTIVA
        // ELC102 (PROGRAMACIÓN GRAFICA) - ELECTIVA

        // SEXTO SEMESTRE (IDs 28-34)
        // ID 28: INF322 (BASE DE DATOS 2), ID 29: INF323 (SISTEMAS OPERATIVOS 1), ID 30: INF329 (COMPILADORES)
        // ID 31: INF342 (SISTEMAS DE INFORMACIÓN 1), ID 32: MAT329 (INVESTIGACIÓN OPERATIVA 1)
        // ID 33: ELC103, ID 34: ELC104
        Prerequisito::create(['materia_id' => 28, 'prerequisito_id' => 22]); // INF322 (BASE DE DATOS 2) -> INF312 (BASE DE DATOS 1)
        Prerequisito::create(['materia_id' => 29, 'prerequisito_id' => 21]); // INF323 (SISTEMAS OPERATIVOS 1) -> INF310 (ESTRUCTURA DE DATOS 2)
        Prerequisito::create(['materia_id' => 30, 'prerequisito_id' => 24]); // INF329 (COMPILADORES) -> INF319 (LENGUAJES FORMALES)
        Prerequisito::create(['materia_id' => 30, 'prerequisito_id' => 21]); // INF329 (COMPILADORES) -> INF310 (ESTRUCTURA DE DATOS 2)
        Prerequisito::create(['materia_id' => 31, 'prerequisito_id' => 22]); // INF342 (SISTEMAS DE INFORMACIÓN 1) -> INF312 (BASE DE DATOS 1)
        Prerequisito::create(['materia_id' => 32, 'prerequisito_id' => 25]); // MAT329 (INVESTIGACIÓN OPERATIVA 1) -> MAT302 (PROBABILIDADES Y ESTADISTICAS 2)
        // ID 33: ELC103 (TOPICOS AVANZADOS DE PROGRAMACIÓN) - ELECTIVA
        // ID 34: ELC104 (PROGRAMACIÓN DE APLICACIONES EN TIEMPO REAL) - ELECTIVA

        // SEPTIMO SEMESTRE (IDs 35-42)
        // ID 35: GRT001, ID 36: INF433 (REDES 1), ID 37: INF413 (SISTEMAS OPERATIVOS 2)
        // ID 38: MAT419, ID 39: INF418 (INTELIGENCIA ARTIFICIAL), ID 40: INF412 (SISTEMAS DE INFORMACIÓN 2)
        // ID 41: ELC105, ID 42: ELC106
        // GRT001 (MODALIDAD DE TITULACION A NIVEL TECNICO SUPERIOR) - Sin prerequisitos
        Prerequisito::create(['materia_id' => 36, 'prerequisito_id' => 29]); // INF433 (REDES 1) -> INF323 (SISTEMAS OPERATIVOS 1)
        Prerequisito::create(['materia_id' => 37, 'prerequisito_id' => 29]); // INF413 (SISTEMAS OPERATIVOS 2) -> INF323 (SISTEMAS OPERATIVOS 1)
        Prerequisito::create(['materia_id' => 38, 'prerequisito_id' => 32]); // MAT419 (INVESTIGACION OPERATIVA 2) -> MAT329 (INVESTIGACIÓN OPERATIVA 1)
        Prerequisito::create(['materia_id' => 39, 'prerequisito_id' => 21]); // INF418 (INTELIGENCIA ARTIFICIAL) -> INF310 (ESTRUCTURA DE DATOS 2)
        Prerequisito::create(['materia_id' => 39, 'prerequisito_id' => 23]); // INF418 (INTELIGENCIA ARTIFICIAL) -> INF318 (PROGRAMACIÓN LOGICA Y FUNCIONAL)
        Prerequisito::create(['materia_id' => 40, 'prerequisito_id' => 31]); // INF412 (SISTEMAS DE INFORMACIÓN 2) -> INF342 (SISTEMAS DE INFORMACIÓN 1)
        Prerequisito::create(['materia_id' => 40, 'prerequisito_id' => 28]); // INF412 (SISTEMAS DE INFORMACIÓN 2) -> INF322 (BASE DE DATOS 2)
        // ID 41: ELC105 (SISTEMAS DISTRIBUIDOS) - ELECTIVA
        // ID 42: ELC106 (INTERACCIÓN HOMBRE - COMPUTADOR) - ELECTIVA

        // OCTAVO SEMESTRE (IDs 43-49)
        // ID 43: INF423 (REDES 2), ID 44: ECO449, ID 45: INF428 (SISTEMAS EXPERTOS)
        // ID 46: INF422 (INGENIERIA DE SOFTWARE 1), ID 47: INF442, ID 48: ELC107, ID 49: ELC108
        Prerequisito::create(['materia_id' => 43, 'prerequisito_id' => 36]); // INF423 (REDES 2) -> INF433 (REDES 1)
        Prerequisito::create(['materia_id' => 44, 'prerequisito_id' => 38]); // ECO449 (PREPARACION Y EVALUACION DE PROYECTOS) -> MAT419 (INVESTIGACION OPERATIVA 2)
        Prerequisito::create(['materia_id' => 45, 'prerequisito_id' => 39]); // INF428 (SISTEMAS EXPERTOS) -> INF418 (INTELIGENCIA ARTIFICIAL)
        Prerequisito::create(['materia_id' => 45, 'prerequisito_id' => 40]); // INF428 (SISTEMAS EXPERTOS) -> INF412 (SISTEMAS DE INFORMACIÓN 2)
        Prerequisito::create(['materia_id' => 46, 'prerequisito_id' => 40]); // INF422 (INGENIERIA DE SOFTWARE 1) -> INF412 (SISTEMAS DE INFORMACIÓN 2)
        Prerequisito::create(['materia_id' => 47, 'prerequisito_id' => 40]); // INF442 (SISTEMAS DE INFORMACIÓN GEOGRÁFICA) -> INF412 (SISTEMAS DE INFORMACIÓN 2)
        // ID 48: ELC107 (CRIPTOGRAFIA Y SEGURIDAD) - ELECTIVA
        // ID 49: ELC108 (CONTROL Y AUTOMATIZACIÓN) - ELECTIVA

        // NOVENO SEMESTRE (IDs 50-53)
        // ID 50: INF511 (TALLER DE GRADO 1), ID 51: INF512 (INGENIERIA DE SOFTWARE 2)
        // ID 52: INF513 (TECNOLOGÍA WEB), ID 53: INF552 (ARQUITECTURA DEL SOFTWARE)
        Prerequisito::create(['materia_id' => 50, 'prerequisito_id' => 46]); // INF511 (TALLER DE GRADO 1) -> INF422 (INGENIERIA DE SOFTWARE 1)
        Prerequisito::create(['materia_id' => 51, 'prerequisito_id' => 43]); // INF512 (INGENIERIA DE SOFTWARE 2) -> INF423 (REDES 2)
        Prerequisito::create(['materia_id' => 52, 'prerequisito_id' => 45]); // INF513 (TECNOLOGÍA WEB) -> INF428 (SISTEMAS EXPERTOS)
        Prerequisito::create(['materia_id' => 53, 'prerequisito_id' => 47]); // INF552 (ARQUITECTURA DEL SOFTWARE) -> INF442 (SISTEMAS DE INFORMACIÓN GEOGRÁFICA)
        Prerequisito::create(['materia_id' => 53, 'prerequisito_id' => 44]); // INF552 (ARQUITECTURA DEL SOFTWARE) -> ECO449 (PREPARACION Y EVALUACION DE PROYECTOS)

        // DECIMO SEMESTRE (ID 54)
        // ID 54: GRL001 (MODALIDAD DE TITULACIÓN LICENCIATURA)
        Prerequisito::create(['materia_id' => 54, 'prerequisito_id' => 50]); // GRL001 -> INF511 (TALLER DE GRADO 1)
        Prerequisito::create(['materia_id' => 54, 'prerequisito_id' => 51]); // GRL001 -> INF512 (INGENIERIA DE SOFTWARE 2)
        Prerequisito::create(['materia_id' => 54, 'prerequisito_id' => 52]); // GRL001 -> INF513 (TECNOLOGÍA WEB)
        Prerequisito::create(['materia_id' => 54, 'prerequisito_id' => 53]); // GRL001 -> INF552 (ARQUITECTURA DEL SOFTWARE)
    }
}
