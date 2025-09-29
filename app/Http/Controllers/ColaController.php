<?php

namespace App\Http\Controllers;

use App\Services\ColaService;
use App\Services\RabbitMQService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ColaController extends Controller
{

    public function __construct(protected ColaService $colaService)
    {
        $this->colaService = $colaService;
    }

    public function asignarWorkers(Request $request)
    {
        $request->validate([
            'cola' => 'required|string',
            'workers' => 'required|integer|min:0'
        ]);

        return $this->colaService->asignarWorkers($request->cola, $request->workers);
    }

    public function estadoHilos()
    {
        return $this->colaService->estadoHilos();
    }

    public function estado(Request $request)
    {
        $request->validate([
            'action' => 'required|string|in:start,stop,status',
            'program' => 'required|string',
        ]);

        $action = $request->input('action');
        $program = $request->input('program');

        // Ejecuta supervisorctl
        $process = new Process([
            'supervisorctl',
            '-c', '/var/www/html/docker/conf.d/supervisord.conf',
            $action,
            $program
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json([
            'action' => $action,
            'program' => $program,
            'output' => explode("\n", trim($process->getOutput()))
        ]);
    }
}
