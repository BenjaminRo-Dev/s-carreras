<?php

namespace App\Http\Controllers;
use App\Services\DocenteService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class DocenteController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(DocenteService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todos los docentes'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registro' => 'required|string|unique:docentes',
            'nombre' => 'required|string',
            'email' => 'nullable|email|unique:docentes',
            'telefono' => 'nullable|string'
        ]);

        $jobId = $this->jobQueueService->enqueue(DocenteService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Docente en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(DocenteService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el docente'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'registro' => 'required|string|unique:docentes,registro,' . $id,
            'nombre' => 'required|string',
            'email' => 'nullable|email|unique:docentes,email,' . $id,
            'telefono' => 'nullable|string'
        ]);
        $jobId = $this->jobQueueService->enqueue(DocenteService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Docente en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(DocenteService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Docente en proceso de eliminación'], 202);
    }
}
