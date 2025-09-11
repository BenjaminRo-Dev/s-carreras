<?php

namespace App\Jobs;

use App\Events\JobFinalizado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

use function Illuminate\Log\log;

class StoreJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    public $tries = 3;
    // public $backoff = 5;

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
            broadcast(new JobFinalizado($this->datos));

            log()->info("Registro creado para el modelo: {$this->modelo}");
        } catch (Throwable $e) {
            log()->error("Error al guardar el modelo '{$this->modelo}': " . $e->getMessage());

        }
    }
}
