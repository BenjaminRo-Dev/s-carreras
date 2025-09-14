<?php

namespace App\Services;

use App\Models\Facultad;

class FacultadService
{   
    public function mostrar($id)
    {
        return Facultad::with('carreras')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        return Facultad::with('carreras')->get();
    }

    public function guardar(array $datos)
    {
        return Facultad::create($datos);
    }

    public function actualizar(array $datos, $id)
    {
        $facultad = Facultad::findOrFail($id);
        $facultad->update($datos);
        return $facultad;
    }

    public function eliminar($id)
    {
        $facultad = Facultad::findOrFail($id);
        $facultad->delete();
        return response()->json(['message' => 'Facultad eliminada']);
    }

}