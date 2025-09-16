<?php

namespace App\Http\Controllers;

use App\Services\ColaAction;
use App\Services\InscripcionService;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    protected $colaAction;

    public function __construct(ColaAction $colaAction)
    {
        $this->colaAction = $colaAction;
    }

    public function index()
    {
        return $this->colaAction->encolar(InscripcionService::class, 'mostrarTodos');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'estudiante_id' => ['required', 'integer'],
            'gestion_id'    => ['required', 'integer'],
            'fecha'         => ['required', 'date'],
            'grupos'        => ['required', 'array', 'min:1'],
            'grupos.*'      => ['integer'],
        ]);

        return $this->colaAction->encolar(InscripcionService::class, 'guardar', $datos);
    }

    public function show(string $id)
    {
        return $this->colaAction->encolar(InscripcionService::class, 'mostrar', $id);
    }

    public function update(Request $request, string $id)
    {
        $datos = $request->validate([
            'estudiante_id' => ['sometimes', 'required', 'integer'],
            'gestion_id'    => ['sometimes', 'required', 'integer'],
            'fecha'         => ['sometimes', 'required', 'date'],
            'grupos'        => ['sometimes', 'required', 'array', 'min:1'],
            'grupos.*'      => ['integer'],
        ]);

        return $this->colaAction->encolar(InscripcionService::class, 'actualizar', $datos, $id);
    }

    public function destroy(string $id)
    {
        return $this->colaAction->encolar(InscripcionService::class, 'eliminar', $id);
    }
}
