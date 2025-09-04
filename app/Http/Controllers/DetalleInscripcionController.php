<?php

namespace App\Http\Controllers;

use App\Models\DetalleInscripcion;
use Illuminate\Http\Request;

class DetalleInscripcionController extends Controller
{
    public function index()
    {
        return DetalleInscripcion::with(['grupo', 'inscripcion'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'fecha' => 'required|date',
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        return DetalleInscripcion::create($request->all());
    }

    public function show(string $id)
    {
        return DetalleInscripcion::with(['grupo', 'inscripcion'])->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $inscripcion = DetalleInscripcion::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        $inscripcion->update($request->all());
        return $inscripcion;
    }

    public function destroy(string $id)
    {
        $inscripcion = DetalleInscripcion::findOrFail($id);
        $inscripcion->delete();
        return response()->noContent();
    }
}
