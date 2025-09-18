<?php

namespace App\Http\Controllers;

use App\Services\ColaAction;
use App\Services\FacultadService;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    protected $colaAction;
    protected $service;

    public function __construct(ColaAction $colaAction, FacultadService $service)
    {
        parent::__construct();
        $this->colaAction = $colaAction;
        $this->service = $service;
    }

    public function index()
    {
        return $this->colaAction->encolar(FacultadService::class, 'mostrarTodos');
    }

    public function show($id)
    {
        return $this->colaAction->encolar(FacultadService::class, 'mostrar', $id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'abreviacion' => 'required|string|max:255',
        ]);

        return $this->usarCola
            ? $this->colaAction->encolar(FacultadService::class, 'guardar', $datos)
            : $this->service->guardar($datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'abreviacion' => 'sometimes|required|string|max:255',
        ]);

        return $this->colaAction->encolar(FacultadService::class, 'actualizar', $datos, $id);
    }

    public function destroy($id)
    {
        return $this->colaAction->encolar(FacultadService::class, 'eliminar', $id);
    }

}
