<?php

namespace App\Jobs;

use Throwable;

use App\Models\JobStatus;
use Illuminate\Bus\Queueable;
use function Illuminate\Log\log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $jobId;
    protected string $modelo;
    protected array $datos;

    public function __construct(string $jobId, string $modelo, array $datos)
    {
        $this->jobId = $jobId;
        $this->modelo = $modelo;
        $this->datos = $datos;
    }

    public function handle(): void
    {
        $status =  JobStatus::find($this->jobId);
        $status->update(['status' => 'processing']);
        try {
            if (!class_exists($this->modelo)) {
                log()->error("Error: La clase del modelo '{$this->modelo}' no existe.");
                return;
            }

            $result =  $this->modelo::create($this->datos);
            $status->update([
                'status' => 'completed',
                'result' => json_encode($result),
            ]);

            log()->info("Registro creado para el modelo: {$this->modelo}");
        } catch (Throwable $e) {
            log()->error("Error al guardar el modelo '{$this->modelo}': " . $e->getMessage());

            $status->update([
                'status' => 'failed',
            ]);
            // reintentar el job: $this->release();
            // marcarlo como fallido: $this->fail($e);
        }
    }
}
