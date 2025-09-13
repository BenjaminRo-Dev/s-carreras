<?php

namespace App\Services;

use App\Models\Docente;
use Illuminate\Support\Facades\Log;

class DocenteService
{
    public function guardar(array $docente)
    {
        return Docente::create($docente);
    }

    public function mostrar(string $id)
    {
        return Docente::with('grupos')->findOrFail($id);
    }
    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para docente");
        return Docente::with('grupos')->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para docente: $id", $datos);
        return Docente::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para docente: $id");
        return Docente::where('id', $id)->delete();
    }
}
