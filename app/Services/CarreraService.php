<?php

namespace App\Services;

use App\Models\Carrera;

class CarreraService
{   
    public function mostrar($id)
    {
        return Carrera::with('planesEstudio.materiaPlanes.materia')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        return Carrera::with('planesEstudio.materiaPlanes.materia')->get();
    }

    public function guardar(array $datos)
    {
        return Carrera::create($datos);
    }

    public function actualizar(array $datos, $id)
    {
        $carrera = Carrera::findOrFail($id);
        $carrera->update($datos);
        return $carrera;
    }

    public function eliminar($id)
    {
        $carrera = Carrera::findOrFail($id);
        $carrera->delete();
        return response()->json(['message' => 'Carrera ' . $carrera->nombre . ' eliminada.']);
    }

}