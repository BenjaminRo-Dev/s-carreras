<?php

namespace App\Http\Controllers;

use App\Services\CarreraService;
use App\Services\ColaAction;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    protected $colaAction;

    public function __construct(ColaAction $colaAction)
    {
        $this->colaAction = $colaAction;
    }

    public function index()
    {
        return $this->colaAction->encolar(CarreraService::class, 'mostrarTodos');
    }

    public function show($id)
    {
        return $this->colaAction->encolar(CarreraService::class, 'mostrar', $id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'facultad_id' => 'required|integer',
        ]);

        return $this->colaAction->encolar(CarreraService::class, 'guardar', $datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'codigo' => 'sometimes|required|string|max:255',
            'nombre' => 'sometimes|required|string|max:255',
            'facultad_id' => 'sometimes|required|integer',
        ]);

        return $this->colaAction->encolar(CarreraService::class, 'actualizar', $datos, $id);
    }

    public function destroy($id)
    {
        return $this->colaAction->encolar(CarreraService::class, 'eliminar', $id);
    }
}
