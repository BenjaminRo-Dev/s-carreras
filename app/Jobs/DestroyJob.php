<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

use function Illuminate\Log\log;

class DestroyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $modelo;
    protected int $id;

    public function __construct(string $modelo, int $id)
    {
        $this->modelo = $modelo;
        $this->id = $id;
    }

    public function handle(): void
    {
        try {
            $this->modelo::destroy($this->id);
            log()->info("Registro eliminado para el modelo: {$this->modelo}");
        } catch (Throwable $e) {
            log()->error("Error al eliminar el modelo '{$this->modelo}': " . $e->getMessage());

            // reintentar el job: $this->release();
            // marcarlo como fallido: $this->fail($e);
        }
    }
}
