<?php

namespace App\Http\Controllers;

use App\Services\ModuloService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class ModuloController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(ModuloService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todos los módulos'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);

        $jobId = $this->jobQueueService->enqueue(ModuloService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Módulo en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(ModuloService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el módulo'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'numero' => 'required|string',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);

        $jobId = $this->jobQueueService->enqueue(ModuloService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Módulo en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(ModuloService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Módulo en proceso de eliminación'], 202);
    }
}
