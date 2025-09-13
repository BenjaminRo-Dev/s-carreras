<?php

namespace App\Services;

use App\Models\Gestion;
use Illuminate\Support\Facades\Log;

class GestionService
{
    public function guardar(array $gestion)
    {
        return Gestion::create($gestion);
    }

    public function mostrar(string $id)
    {
        return Gestion::with(['inscripciones', 'grupos'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para gestion");
        return Gestion::with(['inscripciones', 'grupos'])->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para gestion: $id", $datos);
        return Gestion::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para gestion: $id");
        return Gestion::where('id', $id)->delete();
    }
}
