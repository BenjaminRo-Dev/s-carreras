<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

use function Illuminate\Log\log;

class StoreJob implements ShouldQueue
{
    use Dispatchable;

    protected string $modelo;
    protected array $datos;

    public function __construct(string $modelo, array $datos)
    {
        $this->modelo = $modelo;
        $this->datos = $datos;
    }

    public function handle(): void
    {
        try {
            $this->modelo::create($this->datos);

            log()->info("Registro creado para el modelo: {$this->modelo}");
        } catch (Throwable $e) {
            log()->error("Error al guardar el modelo '{$this->modelo}': " . $e->getMessage());

            // reintentar el job: $this->release();
            // marcarlo como fallido: $this->fail($e);
        }
    }
}
