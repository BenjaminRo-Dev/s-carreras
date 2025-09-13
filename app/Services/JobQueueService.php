<?php

namespace App\Services;

use App\Jobs\JobHandle;
use App\Models\JobStatus;
use Illuminate\Support\Str;
use App\Jobs\StoreJob;

class JobQueueService
{
    /**
     * Encola un trabajo en RabbitMQ y lo guarda en la base de datos.
     *
     * @param string $className  Clase asociada al trabajo (ej: Docente::class)
     * @param array | string | null $payload    Datos que el job necesita
     * @return string            El ID único del job
     */
    public function enqueue(string $serviceClass, string $method, array | string | null $payload): string
    {
        // 1. Generar un UUID único para el job
        $jobId = Str::uuid()->toString();

        // 2. Crear el registro en BD
        JobStatus::create([
            'id'     => $jobId,
            'status' => 'pending',
        ]);

        // 3. Enviar a la cola
        JobHandle::dispatch($jobId, $serviceClass, $method, $payload);

        return $jobId;
    }
}
