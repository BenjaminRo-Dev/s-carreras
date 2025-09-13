<?php

namespace App\Services;

use App\Models\Facultad;
use Illuminate\Support\Facades\Log;

class FacultadService
{
    public function guardar(array $facultad)
    {
        return Facultad::create($facultad);
    }

    public function mostrar(string $id)
    {
        return Facultad::with('carreras')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para facultad");
        return Facultad::with('carreras')->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para facultad: $id", $datos);
        return Facultad::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para facultad: $id");
        return Facultad::where('id', $id)->delete();
    }
}
