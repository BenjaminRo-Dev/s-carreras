<?php

namespace App\Http\Controllers;

use App\Models\JobStatus;
use Illuminate\Http\Request;

class JobStatusController extends Controller
{
    /**
     * Consulta el estado de un job específico
     */
    public function show(string $jobId)
    {
        $jobStatus = JobStatus::find($jobId);

        if (!$jobStatus) {
            return response()->json(['error' => 'Job no encontrado'], 404);
        }

        return response()->json([
            'jobId' => $jobStatus->id,
            'status' => $jobStatus->status,
            'result' => $jobStatus->result,
            'created_at' => $jobStatus->created_at,
            'updated_at' => $jobStatus->updated_at
        ]);
    }

    /**
     * Lista todos los jobs con opción de filtrar por estado
     */
    public function index(Request $request)
    {
        $query = JobStatus::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($jobs);
    }

    /**
     * Elimina un job del registro (para limpieza)
     */
    public function destroy(string $jobId)
    {
        $jobStatus = JobStatus::find($jobId);

        if (!$jobStatus) {
            return response()->json(['error' => 'Job no encontrado'], 404);
        }

        $jobStatus->delete();

        return response()->json(['message' => 'Job eliminado correctamente']);
    }
}
