<?php

namespace App\Http\Controllers;

use App\Jobs\DestroyJob;
use App\Jobs\StoreJob;
use App\Jobs\UpdateJob;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        return Aula::with('horarios')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string',
            'capacidad' => 'nullable|integer|min:1',
            'ubicacion' => 'nullable|string'
        ]);

        StoreJob::dispatch(Aula::class, $request->all());
        return response()->json(['message' => 'Aula en proceso de creación'], 202);

    }

    public function show(string $id)
    {
        return Aula::with('horarios')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'numero' => 'required|string',
            'capacidad' => 'nullable|integer|min:1',
            'ubicacion' => 'nullable|string'
        ]);

        UpdateJob::dispatch(Aula::class, $id, $request->all());
        return response()->json(['message' => 'Aula en proceso de actualización'], 202);

    }

    public function destroy(string $id)
    {
        DestroyJob::dispatch(Aula::class, $id);
        return response()->json(['message' => 'Aula en proceso de eliminación'], 202);
    }
}
