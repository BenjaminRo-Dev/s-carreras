<?php

namespace App\Http\Controllers;

use App\Services\PlanEstudioService;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class PlanEstudioController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    //Materias del ultimo plan de estudio de la {carrera}
    public function getMaterias(String $carrera)
    {
        $jobId = $this->jobQueueService->enqueue(PlanEstudioService::class, 'getMaterias', $carrera);
        return response()->json(['jobId' => $jobId, 'message' => 'Obteniendo materias del plan de estudio'], 202);
    }

    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(PlanEstudioService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Plan de estudio en proceso de eliminación'], 202);
    }
}
