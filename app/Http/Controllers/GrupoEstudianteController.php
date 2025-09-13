<?php

namespace App\Http\Controllers;

use App\Services\GrupoEstudianteService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class GrupoEstudianteController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(GrupoEstudianteService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todos los grupos-estudiantes'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nota' => 'nullable|numeric|min:0|max:100',
            'creditos' => 'required|integer|min:1',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(GrupoEstudianteService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Grupo-estudiante en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(GrupoEstudianteService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el grupo-estudiante'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nota' => 'nullable|numeric|min:0|max:100',
            'creditos' => 'required|integer|min:1',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(GrupoEstudianteService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Grupo-estudiante en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(GrupoEstudianteService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Grupo-estudiante en proceso de eliminación'], 202);
    }

    // Método adicional para obtener notas de un estudiante
    public function notasEstudiante(string $estudiante_id)
    {
        $jobId = $this->jobQueueService->enqueue(GrupoEstudianteService::class, 'notasEstudiante', $estudiante_id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo notas del estudiante'], 202);
    }
}
