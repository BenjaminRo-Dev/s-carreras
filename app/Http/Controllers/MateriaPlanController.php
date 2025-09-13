<?php

namespace App\Http\Controllers;

use App\Services\MateriaPlanService;
use App\Models\MateriaPlan;
use Illuminate\Http\Request;
use App\Services\JobQueueService;

class MateriaPlanController extends Controller
{
    protected $jobQueueService;

    public function __construct(JobQueueService $jobQueueService)
    {
        $this->jobQueueService = $jobQueueService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Método no implementado en el original
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Método no implementado en el original
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Método no implementado en el original
    }

    /**
     * Display the specified resource.
     */
    public function show(MateriaPlan $materiaPlan)
    {
        // Método no implementado en el original
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MateriaPlan $materiaPlan)
    {
        // Método no implementado en el original
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MateriaPlan $materiaPlan)
    {
        // Método no implementado en el original
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobId = $this->jobQueueService->enqueue(MateriaPlanService::class, 'eliminar', $id);
        return response()->json(['jobId' => $jobId, 'message' => 'Materia-plan en proceso de eliminación'], 202);
    }
}
