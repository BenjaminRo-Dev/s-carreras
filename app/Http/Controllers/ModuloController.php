<?php

namespace App\Http\Controllers;

use App\Jobs\DestroyJob;
use App\Jobs\StoreJob;
use App\Jobs\UpdateJob;
use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index()
    {
        return Modulo::with('horarios')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);

        StoreJob::dispatch(Modulo::class, $request->all())->onQueue($request->header('Cola', 'default'));
        return response()->json(['message' => 'Módulo en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        return Modulo::with('horarios')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'numero' => 'required|string',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);

        UpdateJob::dispatch(Modulo::class, $id, $request->all());
        return response()->json(['message' => 'Módulo en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        DestroyJob::dispatch(Modulo::class, $id);
        return response()->json(['message' => 'Módulo en proceso de eliminación'], 202);
    }
}
