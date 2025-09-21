<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class CrudLoteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected array $loteSolicitudes;

    public function __construct(array $loteSolicitudes)
    {
        $this->loteSolicitudes = $loteSolicitudes;
    }

    public function handle(): void
    {
        foreach ($this->loteSolicitudes as $solicitud) {
            $serviceClass = $solicitud['serviceClass'];
            $metodo = $solicitud['metodo'];
            $params = $solicitud['params'];

            try {
                $servicio = App::make($serviceClass);
                
                if (is_array($params)) {
                    call_user_func_array([$servicio, $metodo], $params);
                } else {
                    $servicio->{$metodo}();
                }

            } catch (\Throwable $exception) {
                Log::error("Error al procesar la solicitud en lote: {$exception->getMessage()}");
                // Puedes implementar aquí una lógica de reintento o registro de errores.
            }
        }
    }
}