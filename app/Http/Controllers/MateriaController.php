<?php

namespace App\Http\Controllers;

use App\Services\MateriaService;
use App\Models\Carrera;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class MateriaController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function obtenerMateriasUltimoPlan(Carrera $carrera)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaService::class, 'obtenerMateriasUltimoPlan', $carrera);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo materias del último plan'], 202);
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(MateriaService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todas las materias'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sigla' => 'required|string',
            'nombre' => 'required|string',
            'creditos' => 'required|integer|min:1',
            'nivel_id' => 'required|exists:niveles,id',
            'tipo_id' => 'required|exists:tipos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(MateriaService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Materia en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo la materia'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'sigla' => 'required|string',
            'nombre' => 'required|string',
            'creditos' => 'required|integer|min:1',
            'nivel_id' => 'required|exists:niveles,id',
            'tipo_id' => 'required|exists:tipos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(MateriaService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Materia en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Materia en proceso de eliminación'], 202);
    }
}
