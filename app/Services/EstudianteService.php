<?php

namespace App\Services;

use App\Models\Estudiante;
use Illuminate\Support\Facades\Log;

class EstudianteService
{
    public function guardar(array $estudiante)
    {
        return Estudiante::create($estudiante);
    }

    public function mostrar(string $id)
    {
        return Estudiante::with(['inscripciones', 'materias', 'grupos'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para estudiante");
        return Estudiante::with(['inscripciones', 'materias', 'grupos'])->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para estudiante: $id", $datos);
        return Estudiante::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para estudiante: $id");
        return Estudiante::where('id', $id)->delete();
    }
}
