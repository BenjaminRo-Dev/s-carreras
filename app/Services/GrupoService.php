<?php

namespace App\Services;

use App\Models\Grupo;
use Illuminate\Support\Facades\Log;

class GrupoService
{
    public function guardar(array $grupo)
    {
        return Grupo::create($grupo);
    }

    public function mostrar(string $id)
    {
        return Grupo::with(['materia', 'docente', 'gestion', 'horarios'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para grupo");
        return Grupo::with(['materia', 'docente', 'gestion', 'horarios'])->get();
    }

    public function grupoConEstudiantes()
    {
        Log::info("Ejecutando grupoConEstudiantes para grupo");
        return Grupo::with(['materia', 'docente', 'gestion', 'horarios', 'detallesInscripcion.inscripcion.estudiante'])->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para grupo: $id", $datos);
        return Grupo::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para grupo: $id");
        return Grupo::where('id', $id)->delete();
    }
}
