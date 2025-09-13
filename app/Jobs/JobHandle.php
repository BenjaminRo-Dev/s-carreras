<?php

namespace App\Jobs;

use Throwable;
use App\Models\JobStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobHandle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $jobId;
    protected string $serviceClass;
    protected string $method;
    protected $params;

    public function __construct(string $jobId, string $serviceClass, string $method, array|string|null $params = [])
    {
        $this->jobId = $jobId;
        $this->serviceClass = $serviceClass;
        $this->method = $method;
        $this->params = $params;
    }

    public function handle(): void
    {
        $status = JobStatus::find($this->jobId);
        $status->update(['status' => 'processing']);

        try {
            if (!class_exists($this->serviceClass)) {
                Log::error("Error: La clase de servicio '{$this->serviceClass}' no existe.");
                $status->update(['status' => 'failed']);
                return;
            }

            $service = app()->make($this->serviceClass);

            if (!method_exists($service, $this->method)) {
                Log::error("Error: El método '{$this->method}' no existe en la clase '{$this->serviceClass}'.");
                $status->update(['status' => 'failed']);
                return;
            }

       /*      Log::info("Ejecutando método dinámicamente", [
                'job_id' => $this->jobId,
                'service_class' => $this->serviceClass,
                'method' => $this->method,
              
            ]);
 */
           


            // Ejecutar dinámicamente el método

            if (is_array($this->params)) {
                $result = call_user_func_array([$service, $this->method], $this->params);
            } elseif ($this->params !== null) {
                $result = $service->{$this->method}($this->params);
            } else {
                $result = $service->{$this->method}();
            }

            $status->update([
                'status' => 'completed',
                'result' => json_encode($result),
            ]);

            Log::info("Método {$this->method} ejecutado en {$this->serviceClass}");
            
        } catch (Throwable $e) {
            Log::error("Error al ejecutar '{$this->serviceClass}@{$this->method}': " . $e->getMessage());

            $status->update([
                'status' => 'failed',
            ]);

            // podrías reintentar o marcar como fail aquí
        }
    }
    private function getExecutionType(): string
    {
        if (is_array($this->params)) {
            return 'call_user_func_array';
        } elseif ($this->params !== null) {
            return 'dynamic_method_call_with_param';
        } else {
            return 'dynamic_method_call_no_params';
        }
    }
}
