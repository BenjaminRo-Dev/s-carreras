<?php

namespace App\Http\Controllers;

use App\Jobs\StoreJob;
use App\Jobs\UpdateJob;
use App\Jobs\DestroyJob;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index()
    {
        return "asdasd";
        return Carrera::with('planesEstudio.materiaPlanes.materia')->paginate(1);
    }

    public function show($id)
    {
        return Carrera::with('planesEstudio.materiaPlanes.materia')->findOrFail($id);
    }

    public function store(Request $request)
    {
        StoreJob::dispatch(Carrera::class, $request->all());
        return response()->json(['message' => 'Carrera en proceso de creación'], 202);
    }

    public function update(Request $request, $id)
    {
        UpdateJob::dispatch(Carrera::class, $id, $request->all());
        return response()->json(['message' => 'Carrera en proceso de actualización'], 202);
    }

    public function destroy($id)
    {
        DestroyJob::dispatch(Carrera::class, $id);
        return response()->json(['message' => 'Carrera en proceso de eliminación'], 202);
    }
}
