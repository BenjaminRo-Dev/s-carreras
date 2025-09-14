<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Services\CrudService;
use Illuminate\Http\Request;

class CarreraController extends Controller
{

    // public function index()
    // {
    //     // return Carrera::with('planesEstudio.materiaPlanes.materia')->paginate(1);
    //     $uuid = (string) Str::uuid();
    //     GetAllJob::dispatch(Carrera::class, $uuid);
    //     Cache::put("t:$uuid", "en_proceso", 1800);
    //     return response()->json([
    //         'message' => 'Carreras en proceso de obtención',
    //         'url' => url("api/estado/$uuid"),
    //         'transaction_id' => $uuid,
    //         'status' => 'en_proceso'
    //     ], 202);

    // }

    public function show($id)
    {
        return Carrera::with('planesEstudio.materiaPlanes.materia')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'facultad_id' => 'required|integer|',
        ]);

        return app(CrudService::class)->store(Carrera::class, $datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'codigo' => 'sometimes|required|string|max:255',
            'nombre' => 'sometimes|required|string|max:255',
            'facultad_id' => 'sometimes|required|integer|',
        ]);

        return app(CrudService::class)->update(Carrera::class, $id, $datos);
    }

    public function destroy($id)
    {
        return app(CrudService::class)->destroy(Carrera::class, $id);
    }
}
