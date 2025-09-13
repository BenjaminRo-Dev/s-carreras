<?php

namespace App\Services;

use App\Models\Carrera;
use Illuminate\Support\Facades\Log;

class CarreraService
{
    public function guardar(array $carrera)
    {
        return Carrera::create($carrera);
    }

    public function mostrar(string $id)
    {
        return Carrera::with('planesEstudio.materiaPlanes.materia')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para carrera");
        return Carrera::with('planesEstudio.materiaPlanes.materia')->paginate(1);
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para carrera: $id", $datos);
        return Carrera::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para carrera: $id");
        return Carrera::where('id', $id)->delete();
    }
}
