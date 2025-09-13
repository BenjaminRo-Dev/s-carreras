<?php

namespace App\Services;

use App\Models\PlanEstudio;
use App\Models\Carrera;
use Illuminate\Support\Facades\Log;

class PlanEstudioService
{
    public function getMaterias(string $carrera)
    {
        Log::info("Ejecutando getMaterias para carrera: $carrera");
        $carrera = Carrera::where('nombre', $carrera)->first();

        $ultimoPlan = $carrera->planesEstudio()->orderBy('created_at', 'desc')->first();
        return $ultimoPlan->materias;
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para plan estudio: $id");
        return PlanEstudio::where('id', $id)->delete();
    }
}
