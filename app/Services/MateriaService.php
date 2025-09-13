<?php

namespace App\Services;

use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Support\Facades\Log;

class MateriaService
{
    public function guardar(array $materia)
    {
        return Materia::create($materia);
    }

    public function mostrar(string $id)
    {
        return Materia::with(['nivel', 'tipo', 'prerequisitos', 'esPrerequisitoDe', 'materiaPlanes'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para materia");
        return Materia::with(['nivel', 'tipo', 'prerequisitos', 'esPrerequisitoDe', 'materiaPlanes'])->get();
    }

    public function obtenerMateriasUltimoPlan(Carrera $carrera)
    {
        Log::info("Ejecutando obtenerMateriasUltimoPlan para carrera: {$carrera->id}");
        $ultimoPlan = $carrera->planesEstudio()->orderBy('created_at', 'desc')->first();
        return $ultimoPlan->materias;
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para materia: $id", $datos);
        return Materia::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para materia: $id");
        return Materia::where('id', $id)->delete();
    }
}
