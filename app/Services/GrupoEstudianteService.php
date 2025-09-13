<?php

namespace App\Services;

use App\Models\GrupoEstudiante;
use Illuminate\Support\Facades\Log;

class GrupoEstudianteService
{
    public function guardar(array $grupoEstudiante)
    {
        return GrupoEstudiante::create($grupoEstudiante);
    }

    public function mostrar(string $id)
    {
        return GrupoEstudiante::with(['estudiante', 'grupo'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para grupo estudiante");
        return GrupoEstudiante::with(['estudiante', 'grupo'])->get();
    }

    public function notasEstudiante(string $estudianteId)
    {
        Log::info("Ejecutando notasEstudiante para estudiante: $estudianteId");
        return GrupoEstudiante::with(['estudiante', 'grupo', 'grupo.docente', 'grupo.materia', 'grupo.gestion'])
            ->where('estudiante_id', $estudianteId)
            ->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para grupo estudiante: $id", $datos);
        return GrupoEstudiante::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para grupo estudiante: $id");
        return GrupoEstudiante::where('id', $id)->delete();
    }
}
