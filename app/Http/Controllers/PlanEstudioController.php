<?php

namespace App\Http\Controllers;

use App\Services\ColaAction;
use App\Services\PlanEstudioService;
use Illuminate\Http\Request;

class PlanEstudioController extends Controller
{
    protected $colaAction;

    public function __construct(ColaAction $colaAction)
    {
        $this->colaAction = $colaAction;
    }

    public function index()
    {
        return $this->colaAction->encolar(PlanEstudioService::class, 'mostrarTodos');
    }

    public function show($id)
    {
        return $this->colaAction->encolar(PlanEstudioService::class, 'mostrar', $id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255',
            'cantidad_semestres' => 'required|integer',
            'vigente' => 'required|boolean',
            'carrera_id' => 'required|integer',
        ]);

        return $this->colaAction->encolar(PlanEstudioService::class, 'guardar', $datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'codigo' => 'sometimes|required|string|max:255',
            'cantidad_semestres' => 'sometimes|required|integer',
            'vigente' => 'sometimes|required|boolean',
            'carrera_id' => 'sometimes|required|integer',
        ]);

        return $this->colaAction->encolar(PlanEstudioService::class, 'actualizar', $datos, $id);
    }

    public function destroy($id)
    {
        return $this->colaAction->encolar(PlanEstudioService::class, 'eliminar', $id);
    }

    //TODO: Rehacer esto con su servicio y encolado
    // //Materias del ultimo plan de estudio de la {carrera}
    // public function getMaterias(String $carrera)
    // {
    //     $carrera = Carrera::where('nombre', $carrera)->first();

    //     $ultimoPlan = $carrera->planesEstudio()->orderBy('created_at', 'desc')->first();
    //     $materias = $ultimoPlan->materias;
    //     return $materias;
    // }
}
