<?php

namespace App\Http\Controllers;

use App\Jobs\StoreInscripcionJob;
use App\Models\DetalleInscripcion;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

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

        $uuid = (string) Str::uuid();
        StoreInscripcionJob::dispatch($datos, $uuid);
        Cache::put("t:$uuid", "en_proceso", 1800);

        return response()->json([
            'message' => "Inscripción en proceso",
            'url' => url("api/estado/$uuid"),
            'transaction_id' => $uuid,
            'status' => 'en_proceso'
        ], 202);
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
