<?php

namespace App\Http\Controllers;

use App\Services\CarreraService;
use App\Services\ColaAction;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    protected $colaAction;
    protected $service;

    public function __construct(ColaAction $colaAction, CarreraService $service)
    {
        parent::__construct(); 
        $this->colaAction = $colaAction;
        $this->service = $service;
    }

    public function index()
    {
        $cola = request()->header('cola', "default");
        return $this->colaAction->encolar(CarreraService::class, 'mostrarTodos', $cola);
    }

    public function show($id)
    {
        $cola = request()->header('cola', "default");
        return $this->colaAction->encolar(CarreraService::class, 'mostrar', $cola, $id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'facultad_id' => 'required|integer',
        ]);

        $cola = $request->header('cola', "default");
        $lote = $request->header('lote', "false");

        if($lote == 'true'){
            return $this->colaAction->encolarLote(CarreraService::class, 'guardar', $cola, $datos);
        }

        return $this->usarCola
            ? $this->colaAction->encolar(CarreraService::class, 'guardar', $cola, $datos)
            : $this->service->guardar($datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'codigo' => 'sometimes|required|string|max:255',
            'nombre' => 'sometimes|required|string|max:255',
            'facultad_id' => 'sometimes|required|integer',
        ]);
        $cola = request()->header('cola', "default");

        return $this->colaAction->encolar(CarreraService::class, 'actualizar', $cola, $datos, $id);
    }

    public function destroy($id)
    {
        $cola = request()->header('cola', "default");

        return $this->colaAction->encolar(CarreraService::class, 'eliminar', $cola, $id);
    }
}
