<?php

namespace App\Services;

use App\Models\Aula;
use Illuminate\Support\Facades\Log;

class AulaService
{
    public function guardar(array $aula)
    {
        return Aula::create($aula);
    }

    public function mostrar(string $id)
    {
        return Aula::with('horarios')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para aula");
        return Aula::with('horarios')->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para aula: $id", $datos);
        return Aula::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para aula: $id");
        return Aula::where('id', $id)->delete();
    }
}
