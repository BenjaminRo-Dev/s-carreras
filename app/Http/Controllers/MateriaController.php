<?php

namespace App\Http\Controllers;

use App\Services\ColaAction;
use App\Services\MateriaService;
use Illuminate\Http\Request;

class MateriaController extends Controller
{

    protected $colaAction;
    protected $service;

    public function __construct(ColaAction $colaAction, MateriaService $service)
    {
        parent::__construct();
        $this->colaAction = $colaAction;
        $this->service = $service;
    }

    public function index()
    {
        return $this->colaAction->encolar(MateriaService::class, 'mostrarTodos');
    }

    public function show(string $id)
    {
        return $this->colaAction->encolar(MateriaService::class, 'mostrar', $id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'sigla' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'creditos' => 'required|integer',
            'nivel_id' => 'required|integer',
            'tipo_id' => 'required|integer',
            'prerequisitos' => 'sometimes|array',
            'prerequisitos.*' => 'integer|distinct',
        ]);

        return $this->usarCola
            ? $this->colaAction->encolar(MateriaService::class, 'guardar', $datos)
            : $this->service->guardar($datos);
    }

    public function update(Request $request, string $id)
    {
        $datos = $request->validate([
            'sigla' => 'sometimes|string|max:255',
            'nombre' => 'sometimes|string|max:255',
            'creditos' => 'sometimes|integer',
            'nivel_id' => 'sometimes|integer',
            'tipo_id' => 'sometimes|integer',
            'prerequisitos' => 'sometimes|array',
            'prerequisitos.*' => 'integer|distinct',
        ]);

        return $this->colaAction->encolar(MateriaService::class, 'actualizar', $datos, $id);
    }

    public function destroy(string $id)
    {
        return $this->colaAction->encolar(MateriaService::class, 'eliminar', $id);
    }

}
