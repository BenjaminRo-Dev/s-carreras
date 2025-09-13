<?php

namespace App\Http\Controllers;

use App\Services\CarreraService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class CarreraController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(CarreraService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todas las carreras'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string',
            'nombre' => 'required|string',
            'facultad_id' => 'required|exists:facultades,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(CarreraService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Carrera en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(CarreraService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo la carrera'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'codigo' => 'required|string',
            'nombre' => 'required|string',
            'facultad_id' => 'required|exists:facultades,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(CarreraService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Carrera en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(CarreraService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Carrera en proceso de eliminación'], 202);
    }
}
