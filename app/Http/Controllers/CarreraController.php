<?php

namespace App\Http\Controllers;

use App\Jobs\StoreJob;
use App\Jobs\UpdateJob;
use App\Jobs\DestroyJob;
use App\Models\Carrera;
use App\Traits\DestroyTrait;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CarreraController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DestroyTrait;

    protected string $modelo = Carrera::class;

    public function index()
    {
        return Carrera::with('planesEstudio.materiaPlanes.materia')->paginate(1);
    }

    public function show($id)
    {
        return Carrera::with('planesEstudio.materiaPlanes.materia')->findOrFail($id);
    }

    // public function store(Request $request)
    // {
    //     $uuid = (string) Str::uuid();
    //     StoreJob::dispatch(Carrera::class, $request->all(), $uuid);
    //     Cache::put("t:$uuid", "en_proceso", 1800);
    //     return response()->json([
    //         'message' => 'Carrera en proceso de creación',
    //         'url' => url("api/estado/$uuid"),
    //         'transaction_id' => $uuid,
    //         'status' => 'en_proceso'
    //     ], 202);
    // }

    // public function update(Request $request, $id)
    // {
    //     UpdateJob::dispatch(Carrera::class, $id, $request->all());
    //     return response()->json(['message' => 'Carrera en proceso de actualización'], 202);
    // }

    // public function destroy($id)
    // {
    //     DestroyJob::dispatch(Carrera::class, $id);
    //     return response()->json(['message' => 'Carrera en proceso de eliminación'], 202);
    // }
}
