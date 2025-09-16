<?php

namespace App\Http\Controllers;

use App\Jobs\DestroyJob;
use App\Jobs\StoreJob;
use App\Jobs\UpdateJob;
use App\Models\Estudiante;
use App\Services\ColaAction;
use App\Services\EstudianteService;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{

    protected $colaAction;

    public function __construct(ColaAction $colaAction)
    {
        $this->colaAction = $colaAction;
    }

    public function index()
    {
        return $this->colaAction->encolar(EstudianteService::class, 'mostrarTodos');
    }

    public function show(string $id)
    {
        return $this->colaAction->encolar(EstudianteService::class, 'mostrar', $id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'registro' => 'required|string',
            'nombre' => 'required|string',
            'email' => 'nullable|email',
            'telefono' => 'nullable|string',
            'plan_estudio_id' => 'required|integer'
        ]);

        return $this->colaAction->encolar(EstudianteService::class, 'guardar', $request->all());
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'registro' => 'required|string',
            'nombre' => 'required|string',
            'email' => 'nullable|email',
            'telefono' => 'nullable|string'
        ]);

        return $this->colaAction->encolar(EstudianteService::class, 'actualizar', $request->all(), $id);
    }

    public function destroy(string $id)
    {
        return $this->colaAction->encolar(EstudianteService::class, 'eliminar', $id);
    }
}
