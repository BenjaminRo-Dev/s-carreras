<?php

namespace App\Services;

use App\Models\DetalleInscripcion;
use Illuminate\Support\Facades\Log;

class DetalleInscripcionService
{
    public function guardar(array $detalleInscripcion)
    {
        return DetalleInscripcion::create($detalleInscripcion);
    }

    public function mostrar(string $id)
    {
        return DetalleInscripcion::with(['grupo', 'inscripcion'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para detalle inscripcion");
        return DetalleInscripcion::with(['grupo', 'inscripcion'])->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para detalle inscripcion: $id", $datos);
        return DetalleInscripcion::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para detalle inscripcion: $id");
        return DetalleInscripcion::where('id', $id)->delete();
    }
}
