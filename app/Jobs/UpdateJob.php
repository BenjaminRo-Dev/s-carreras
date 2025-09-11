<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Throwable;

use function Illuminate\Log\log;

class UpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $modelo;
    protected array $datos;
    protected int $id;
    public string $uuid;
    public $tries = 3;

    public function __construct(string $modelo, int $id, array $datos, string $uuid)
    {
        $this->modelo = $modelo;
        $this->id = $id;
        $this->datos = $datos;
        $this->uuid = $uuid;
    }

    public function handle(): void
    {
        try {
            $this->modelo::where('id', $this->id)->update($this->datos);
            Cache::forget("t:{$this->uuid}");
        } catch (Throwable $e) {
            Cache::put("t:{$this->uuid}", "fallido", 3600);
            // log()->error("Error al actualizar el modelo '{$this->modelo}': " . $e->getMessage());
        }
    }
}
