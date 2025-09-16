<?php

namespace App\Services;

use App\Models\PlanEstudio;

class PlanEstudioService
{   
    public function mostrar($id)
    {
        return PlanEstudio::with('carrera', 'materiaPlanes.materia')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        return PlanEstudio::with('carrera', 'materiaPlanes.materia')->get();
    }

    public function guardar(array $datos)
    {
        return PlanEstudio::create($datos);
    }

    public function actualizar(array $datos, $id)
    {
        $plan = PlanEstudio::findOrFail($id);
        $plan->update($datos);
        return $plan;
    }

    public function eliminar($id)
    {
        $plan = PlanEstudio::findOrFail($id);
        $plan->delete();
        return response()->json(['message' => 'Plan de estudio ' . $plan->codigo . ' eliminado.']);
    }

}