<?php

namespace App\Http\Controllers;

use App\Jobs\DestroyJob;
use App\Jobs\StoreJob;
use App\Jobs\UpdateJob;
use App\Models\Modulo;
use App\Services\ColaAction;
use App\Services\ModuloService;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    protected $colaAction;

    public function __construct(ColaAction $colaAction)
    {
        $this->colaAction = $colaAction;
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

        return $this->colaAction->encolar(ModuloService::class, 'guardar', $datos);
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
