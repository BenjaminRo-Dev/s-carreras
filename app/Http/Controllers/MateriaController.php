<?php

namespace App\Http\Controllers;

use App\Jobs\DestroyJob;
use App\Jobs\StoreJob;
use App\Jobs\UpdateJob;
use App\Models\Carrera;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{

    public function obtenerMateriasUltimoPlan(Carrera $carrera)
    {
        $ultimoPlan = $carrera->planesEstudio()->orderBy('created_at', 'desc')->first();
        $materias = $ultimoPlan->materias;
        return $materias;
    }

    public function index()
    {
        return Materia::with(['nivel', 'tipo', 'prerequisitos', 'esPrerequisitoDe', 'materiaPlanes'])->get();
    }

    public function store(Request $request)
    {
        StoreJob::dispatch(Materia::class, $request->all());
        return response()->json(['message' => 'Materia en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        return Materia::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        UpdateJob::dispatch(Materia::class, $id, $request->all());
        return response()->json(['message' => 'Materia en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        DestroyJob::dispatch(Materia::class, $id);
        return response()->json(['message' => 'Materia en proceso de eliminación'], 202);
    }
}
