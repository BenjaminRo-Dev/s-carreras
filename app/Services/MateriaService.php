<?php

namespace App\Services;

use App\Models\Materia;

class MateriaService
{   
    public function mostrar($id)
    {
        return Materia::with('nivel', 'tipo', 'prerequisitos', 'esPrerequisitoDe', 'materiaPlanes')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        return Materia::with('nivel', 'tipo', 'prerequisitos', 'esPrerequisitoDe', 'materiaPlanes')->get();
    }

    public function guardar(array $datos)
    {
        return Materia::create($datos);
    }

    public function actualizar(array $datos, $id)
    {
        $materia = Materia::findOrFail($id);
        $materia->update($datos);
        return $materia;
    }

    public function eliminar($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();
        return response()->json(['message' => 'Materia ' . $materia->nombre . ' eliminada.']);
    }

}