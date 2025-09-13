<?php

namespace App\Http\Controllers;

use App\Services\DetalleInscripcionService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class DetalleInscripcionController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(DetalleInscripcionService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todos los detalles de inscripción'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(DetalleInscripcionService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Detalle de inscripción en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(DetalleInscripcionService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el detalle de inscripción'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(DetalleInscripcionService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Detalle de inscripción en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(DetalleInscripcionService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Detalle de inscripción en proceso de eliminación'], 202);
    }
}
