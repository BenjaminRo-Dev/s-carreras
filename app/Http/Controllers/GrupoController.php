<?php

namespace App\Http\Controllers;

use App\Services\GrupoService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class GrupoController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(GrupoService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todos los grupos'], 202);
    }

    public function grupoConEstudiantes()
    {
        $jobId = $this->jobQueueService->enqueue(GrupoService::class, 'grupoConEstudiantes', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo grupos con estudiantes'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sigla' => 'required|string',
            'cupo' => 'required|integer|min:1',
            'materia_id' => 'required|exists:materias,id',
            'docente_id' => 'required|exists:docentes,id',
            'gestion_id' => 'required|exists:gestiones,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(GrupoService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Grupo en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(GrupoService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el grupo'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'sigla' => 'required|string',
            'cupo' => 'required|integer|min:1',
            'materia_id' => 'required|exists:materias,id',
            'docente_id' => 'required|exists:docentes,id',
            'gestion_id' => 'required|exists:gestiones,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(GrupoService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Grupo en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(GrupoService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Grupo en proceso de eliminación'], 202);
    }
}
