<?php

namespace App\Services;

use App\Models\Grupo;

class GrupoService
{   
    public function mostrar($id)
    {
        return Grupo::with('materia', 'docente', 'gestion', 'horarios')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        return Grupo::with('materia', 'docente', 'gestion', 'horarios')->get();
    }

    public function guardar(array $datos)
    {
        return Grupo::create($datos);
        
    }

    public function actualizar(array $datos, $id)
    {
        $grupo = Grupo::findOrFail($id);
        $grupo->update($datos);
        return $grupo;
    }

    public function eliminar($id)
    {
        $grupo = Grupo::findOrFail($id);
        $grupo->delete();
        return response()->json(['message' => 'Grupo ' . $grupo->sigla . ' eliminado.']);
    }

}