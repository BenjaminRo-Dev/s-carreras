<?php

namespace App\Http\Controllers;

use App\Jobs\StoreInscripcionJob;
use App\Models\DetalleInscripcion;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        return Inscripcion::with([
            'estudiante',
            'gestion',
            'detalle',
            'detalle.grupo',
            'detalle.grupo.materia',
            'detalle.grupo.docente',
            'detalle.grupo.horarios',
            'detalle.grupo.horarios.modulo',
            'detalle.grupo.horarios.aula',
        ])->get();
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'estudiante_id' => ['required', 'integer'],
            'gestion_id'    => ['required', 'integer'],
            'fecha'         => ['required', 'date'],
            'grupos'        => ['required', 'array', 'min:1'],
            'grupos.*'      => ['integer'],
        ]);

        StoreInscripcionJob::dispatch($datos)->onQueue('alta');

        return response()->json(['message' => 'Inscripción en proceso'], 202);
    }


    public function show(string $id)
    {
        return Inscripcion::with([
            'estudiante',
            'gestion',
            'detalle',
            'detalle.grupo',
            'detalle.grupo.materia',
            'detalle.grupo.docente',
            'detalle.grupo.horarios',
            'detalle.grupo.horarios.modulo',
            'detalle.grupo.horarios.aula',
        ])->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'gestion_id' => 'required|exists:gestiones,id'
        ]);

        $inscripcion->update($request->all());
        return $inscripcion;
    }

    public function destroy(string $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();
        return response()->noContent();
    }
}
