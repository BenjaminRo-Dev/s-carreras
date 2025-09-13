<?php

namespace App\Http\Controllers;

use App\Services\GestionService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class GestionController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(GestionService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todas las gestiones'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'año' => 'required|integer|min:2000|max:2100',
            'periodo' => 'required|integer|in:1,2'
        ]);

        $jobId = $this->jobQueueService->enqueue(GestionService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Gestión en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(GestionService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo la gestión'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'año' => 'required|integer|min:2000|max:2100',
            'periodo' => 'required|integer|in:1,2'
        ]);

        $jobId = $this->jobQueueService->enqueue(GestionService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Gestión en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(GestionService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Gestión en proceso de eliminación'], 202);
    }
}
