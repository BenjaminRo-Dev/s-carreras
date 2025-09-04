<?php

namespace App\Jobs;

use App\Models\DetalleInscripcion;
use App\Models\Inscripcion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class StoreInscripcionJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $backoff = 5;

    protected array $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    public function handle(): void
    {
        DB::transaction(function () {
            $inscripcion = Inscripcion::create([
                'estudiante_id' => $this->datos['estudiante_id'],
                'gestion_id'    => $this->datos['gestion_id'],
                'fecha'         => $this->datos['fecha'],
            ]);

            foreach ($this->datos['grupos'] as $grupoId) {
                DetalleInscripcion::create([
                    'inscripcion_id' => $inscripcion->id,
                    'grupo_id'       => $grupoId,
                ]);
            }
        });
    }
}
