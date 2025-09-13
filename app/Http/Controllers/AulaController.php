<?php

namespace App\Http\Controllers;

use App\Services\AulaService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class AulaController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(AulaService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todas las aulas'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string',
            'capacidad' => 'nullable|integer|min:1',
            'ubicacion' => 'nullable|string'
        ]);

        $jobId = $this->jobQueueService->enqueue(AulaService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Aula en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(AulaService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el aula'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'numero' => 'required|string',
            'capacidad' => 'nullable|integer|min:1',
            'ubicacion' => 'nullable|string'
        ]);

        $jobId = $this->jobQueueService->enqueue(AulaService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Aula en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(AulaService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Aula en proceso de eliminación'], 202);
    }
}
