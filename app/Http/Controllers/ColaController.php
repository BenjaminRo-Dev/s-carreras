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

    public function estadoUnHilo(Request $request)
    {
        $request->validate([
            'accion' => 'required|string|in:start,stop,status',
            'hilo' => 'required|string',
        ]);

        return $this->colaService->estadoUnHilo($request->accion, $request->hilo);
    }
}
