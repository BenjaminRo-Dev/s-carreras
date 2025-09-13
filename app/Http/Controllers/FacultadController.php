<?php

namespace App\Http\Controllers;

use App\Services\FacultadService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class FacultadController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(FacultadService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todas las facultades'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'abreviacion' => 'required|string'
        ]);

        $jobId = $this->jobQueueService->enqueue(FacultadService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Facultad en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(FacultadService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo la facultad'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'abreviacion' => 'required|string'
        ]);

        $jobId = $this->jobQueueService->enqueue(FacultadService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Facultad en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(FacultadService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Facultad en proceso de eliminación'], 202);
    }
}
