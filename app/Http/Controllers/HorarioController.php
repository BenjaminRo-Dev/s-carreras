<?php

namespace App\Http\Controllers;

use App\Services\HorarioService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class HorarioController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    public function index()
    {
        $jobId = $this->jobQueueService->enqueue(HorarioService::class, 'mostrarTodos', null);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo todos los horarios'], 202);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dia' => 'required|string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'grupo_id' => 'required|exists:grupos,id',
            'aula_id' => 'required|exists:aulas,id',
            'modulo_id' => 'required|exists:modulos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(HorarioService::class, 'guardar', $validated);

        return response()->json(['jobId' => $jobId, 'message' => 'Horario en proceso de creación'], 202);
    }

    public function show(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(HorarioService::class, 'mostrar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo el horario'], 202);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'dia' => 'required|string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'grupo_id' => 'required|exists:grupos,id',
            'aula_id' => 'required|exists:aulas,id',
            'modulo_id' => 'required|exists:modulos,id'
        ]);

        $jobId = $this->jobQueueService->enqueue(HorarioService::class, 'actualizar', [$id, $validated]);
        return response()->json(['jobId' => $jobId, 'message' => 'Horario en proceso de actualización'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(HorarioService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Horario en proceso de eliminación'], 202);
    }
}
