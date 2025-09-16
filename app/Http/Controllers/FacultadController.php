<?php

namespace App\Http\Controllers;

use App\Services\ColaAction;
use App\Services\FacultadService;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    protected $colaAction;
    
    public function __construct(ColaAction $colaAction)
    {
        $this->colaAction = $colaAction;
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

        return $this->colaAction->encolar(FacultadService::class, 'guardar', $datos);
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
