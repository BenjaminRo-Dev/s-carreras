<?php

namespace App\Http\Controllers;

use App\Services\MateriaEstudianteService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class MateriaEstudianteController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(MateriaEstudianteService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todas las materias-estudiantes'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nota' => 'nullable|numeric|min:0|max:100',
            'creditos' => 'required|integer|min:1',
            'materia_id' => 'required|exists:materias,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(MateriaEstudianteService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Materia-estudiante en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaEstudianteService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo la materia-estudiante'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nota' => 'nullable|numeric|min:0|max:100',
            'creditos' => 'required|integer|min:1',
            'materia_id' => 'required|exists:materias,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(MateriaEstudianteService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Materia-estudiante en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaEstudianteService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Materia-estudiante en proceso de eliminación'], 202);
    }

    // Método adicional para obtener notas de un estudiante
    public function notasEstudiante(string $estudiante_id)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaEstudianteService::class, 'notasEstudiante', $estudiante_id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo notas del estudiante'], 202);
    }

    // Método adicional para obtener estudiantes de una materia
    public function estudiantesMateria(string $materia_id)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaEstudianteService::class, 'estudiantesMateria', $materia_id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo estudiantes de la materia'], 202);
    }
}
