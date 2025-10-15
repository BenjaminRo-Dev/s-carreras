<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        return Docente::with('grupos')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'registro' => 'required|string|unique:docentes',
            'codigo' => 'required|string',
            'nombre' => 'required|string',
            'email' => 'nullable|email|unique:docentes',
            'telefono' => 'nullable|string'
        ]);

        return Docente::create($request->all());
    }

    public function show(string $id)
    {
        return Docente::with('grupos')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $docente = Docente::findOrFail($id);

        $request->validate([
            'registro' => 'required|string|unique:docentes,registro,' . $id,
            'codigo' => 'required|string',
            'nombre' => 'required|string',
            'email' => 'nullable|email|unique:docentes,email,' . $id,
            'telefono' => 'nullable|string'
        ]);

        $docente->update($request->all());
        return $docente;
    }

    public function destroy(string $id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();
        return response()->noContent();
    }
}
