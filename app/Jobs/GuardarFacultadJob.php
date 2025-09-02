<?php

namespace App\Jobs;

use App\Models\Facultad;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use function Illuminate\Log\log;

class GuardarFacultadJob implements ShouldQueue
{
    use Queueable;

    protected array $dato;

    public function __construct(array $dato)
    {
        $this->dato = $dato;
    }

    public function handle(): void
    {
        try {
            Facultad::create($this->dato);
            log()->info("Facultad creada.");
        } catch (\Throwable $e) {
            log()->error("Error al guardar facultad: " . $e->getMessage());
            // TODO: Definir si se reintenta, si se registra como fallido, etc.,
        }
    }

    // public function viaQueue()
    // {
    //     return 'principal';
    // }
}
