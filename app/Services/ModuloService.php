<?php

namespace App\Services;

use App\Models\Modulo;
use Illuminate\Support\Facades\Log;

class ModuloService
{
    public function guardar(array $modulo)
    {
        return Modulo::create($modulo);
    }

    public function mostrar(string $id)
    {
        return Modulo::with('horarios')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para modulo");
        return Modulo::with('horarios')->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para modulo: $id", $datos);
        return Modulo::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para modulo: $id");
        return Modulo::where('id', $id)->delete();
    }
}
