<?php

namespace App\Services;

use App\Models\Inscripcion;
use Illuminate\Support\Facades\Log;

class InscripcionService
{
    public function guardar(array $inscripcion)
    {
        return Inscripcion::create($inscripcion);
    }

    public function mostrar(string $id)
    {
        return Inscripcion::with([
            'estudiante',
            'gestion',
            'detalle',
            'detalle.grupo',
            'detalle.grupo.materia',
            'detalle.grupo.docente',
            'detalle.grupo.horarios',
            'detalle.grupo.horarios.modulo',
            'detalle.grupo.horarios.aula',
        ])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para inscripcion");
        return Inscripcion::with([
            'estudiante',
            'gestion',
            'detalle',
            'detalle.grupo',
            'detalle.grupo.materia',
            'detalle.grupo.docente',
            'detalle.grupo.horarios',
            'detalle.grupo.horarios.modulo',
            'detalle.grupo.horarios.aula',
        ])->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para inscripcion: $id", $datos);
        return Inscripcion::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para inscripcion: $id");
        return Inscripcion::where('id', $id)->delete();
    }
}
