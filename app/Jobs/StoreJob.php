<?php

namespace App\Jobs;

use App\Events\JobFinalizado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Throwable;

use function Illuminate\Log\log;

class StoreJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    public $tries = 3;
    // public $backoff = 5;

    protected string $modelo;
    protected array $datos;
    public string $uuid;

    public function __construct(string $modelo, array $datos, string $uuid)
    {
        $this->modelo = $modelo;
        $this->datos = $datos;
        $this->uuid = $uuid;
    }

    public function handle(): void
    {
        try {
            $this->modelo::create($this->datos);
            Cache::forget("t:{$this->uuid}");
            // broadcast(new JobFinalizado($this->datos));

            // log()->info("Registro creado para el modelo: {$this->modelo}");
        } catch (Throwable $e) {
            Cache::put("t:{$this->uuid}", "fallido", 3600);
            // log()->error("Error al guardar el modelo '{$this->modelo}': " . $e->getMessage());
        }
    }
}
