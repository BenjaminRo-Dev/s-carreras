<?php

namespace App\Http\Controllers;

use App\Services\ColaAction;
use App\Services\ModuloService;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    protected $colaAction;
    protected $service;

    public function __construct(ColaAction $colaAction, ModuloService $service)
    {
        parent::__construct();
        $this->colaAction = $colaAction;
        $this->service = $service;
    }
    
    public function index()
    {
        return $this->colaAction->encolar(ModuloService::class, 'mostrarTodos');
    }

    public function show(string $id)
    {
        return $this->colaAction->encolar(ModuloService::class, 'mostrar', $id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'numero' => 'required|string',
            'cant_aulas' => 'required|integer|min:1|max:50',
        ]);

        return $this->usarCola
            ? $this->colaAction->encolar(ModuloService::class, 'guardar', $datos)
            : $this->service->guardar($datos);
    }

    public function update(Request $request, string $id)
    {
        $datos = $request->validate([
            'numero' => 'required|string',
            'cant_aulas' => 'required|integer|min:1|max:50',
        ]);

        return $this->colaAction->encolar(ModuloService::class, 'actualizar', $datos, $id);
    }

    public function destroy(string $id)
    {
        return $this->colaAction->encolar(ModuloService::class, 'eliminar', $id);
    }
}
