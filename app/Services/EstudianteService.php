<?php

namespace App\Services;

use App\Models\Estudiante;

class EstudianteService
{   
    public function mostrar($id)
    {
        return Estudiante::with(['user', 'planEstudio', 'grupoEstudiantes', 'inscripciones'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        return Estudiante::with(['user', 'planEstudio', 'grupoEstudiantes', 'inscripciones'])->get();
    }

    public function guardar(array $datos)
    {
        return Estudiante::create($datos);
    }

    public function actualizar(array $datos, $id)
    {
        $carrera = Estudiante::findOrFail($id);
        $carrera->update($datos);
        return $carrera;
    }

    public function eliminar($id)
    {
        $carrera = Estudiante::findOrFail($id);
        $carrera->delete();
        return response()->json(['message' => 'Estudiante ' . $carrera->nombre . ' eliminado.']);
    }

}