<?php

namespace App\Http\Controllers;

use App\Services\ColaAction;
use App\Services\GrupoService;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    protected $colaAction;

    public function __construct(ColaAction $colaAction)
    {
        $this->colaAction = $colaAction;
    }

    public function index()
    {
        return $this->colaAction->encolar(GrupoService::class, 'mostrarTodos');
    }

    public function show($id)
    {
        return $this->colaAction->encolar(GrupoService::class, 'mostrar', $id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'sigla' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'cupo' => 'required|integer|min:1',
            'materia_id' => 'required|integer',
            'docente_id' => 'required|integer',
            'gestion_id' => 'required|integer',
        ]);

        return $this->colaAction->encolar(GrupoService::class, 'guardar', $datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'sigla' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'cupo' => 'required|integer|min:1',
            'materia_id' => 'required|integer',
            'docente_id' => 'required|integer',
            'gestion_id' => 'required|integer',
        ]);

        return $this->colaAction->encolar(GrupoService::class, 'actualizar', $datos, $id);
    }

    public function destroy(string $id)
    {
        return $this->colaAction->encolar(GrupoService::class, 'eliminar', $id);
    }
}
