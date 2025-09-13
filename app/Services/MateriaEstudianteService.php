<?php

namespace App\Services;

use App\Models\MateriaEstudiante;
use Illuminate\Support\Facades\Log;

class MateriaEstudianteService
{
    public function guardar(array $materiaEstudiante)
    {
        return MateriaEstudiante::create($materiaEstudiante);
    }

    public function mostrar(string $id)
    {
        return MateriaEstudiante::with(['materia', 'estudiante', 'grupo'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para materia estudiante");
        return MateriaEstudiante::with(['materia', 'estudiante', 'grupo'])->get();
    }

    public function notasEstudiante(string $estudianteId)
    {
        Log::info("Ejecutando notasEstudiante para estudiante: $estudianteId");
        return MateriaEstudiante::with(['materia', 'grupo'])
            ->where('estudiante_id', $estudianteId)
            ->get();
    }

    public function estudiantesMateria(string $materiaId)
    {
        Log::info("Ejecutando estudiantesMateria para materia: $materiaId");
        return MateriaEstudiante::with(['estudiante', 'grupo'])
            ->where('materia_id', $materiaId)
            ->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para materia estudiante: $id", $datos);
        return MateriaEstudiante::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para materia estudiante: $id");
        return MateriaEstudiante::where('id', $id)->delete();
    }
}
