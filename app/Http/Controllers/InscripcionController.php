<?php

namespace App\Http\Controllers;

use App\Services\InscripcionService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class InscripcionController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(InscripcionService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todas las inscripciones'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'gestion_id' => 'required|exists:gestiones,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(InscripcionService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Inscripción en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(InscripcionService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo la inscripción'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'gestion_id' => 'required|exists:gestiones,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(InscripcionService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Inscripción en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(InscripcionService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Inscripción en proceso de eliminación'], 202);
    }
}
