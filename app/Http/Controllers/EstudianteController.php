<?php

namespace App\Http\Controllers;

use App\Services\EstudianteService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class EstudianteController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(EstudianteService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todos los estudiantes'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registro' => 'required|string|unique:estudiantes',
            'nombre' => 'required|string',
            'email' => 'nullable|email|unique:estudiantes',
            'telefono' => 'nullable|string'
        ]);

        $jobId = $this->jobQueueService->enqueue(EstudianteService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Estudiante en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(EstudianteService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el estudiante'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'registro' => 'required|string|unique:estudiantes,registro,' . $id,
            'nombre' => 'required|string',
            'email' => 'nullable|email|unique:estudiantes,email,' . $id,
            'telefono' => 'nullable|string'
        ]);

        $jobId = $this->jobQueueService->enqueue(EstudianteService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Estudiante en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(EstudianteService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Estudiante en proceso de eliminación'], 202);
    }
}
