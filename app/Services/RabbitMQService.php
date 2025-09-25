<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RabbitMQService
{
    protected string $host;
    protected string $user;
    protected string $password;

    public function __construct()
    {
        $this->host = config('queue.connections.rabbitmq.management.host');
        $this->user = config('queue.connections.rabbitmq.management.user');
        $this->password = config('queue.connections.rabbitmq.management.password');
    }

    public function getInfoColas(): array
    {
        $respuesta = Http::withBasicAuth($this->user, $this->password)
            ->timeout(30)
            ->retry(3, 100)
            ->get("{$this->host}/api/queues");

        if ($respuesta->failed()) {
            Log::error('Error conectando a RabbitMQ API', [
                'status' => $respuesta->status(),
                'error' => $respuesta->body()
            ]);

            throw new \Exception("No se pudo conectar con la API de RabbitMQ: " . $respuesta->status());
        }

        return $respuesta->json();
    }

    public function getLongitudesColas(): array
    {
        $infoColas = $this->getInfoColas();

        $longitudes = [];

        foreach ($infoColas as $cola) {
            $longitudes[$cola['name']] = $cola['messages_ready'] ?? 0;
        }

        return $longitudes;
    }

    protected function colaMasCorta(): string
    {
        $longitudes = $this->getLongitudesColas();
        
        if (empty($longitudes)) return 'default';
        
        asort($longitudes); // ordenar de menor a mayor
        return array_key_first($longitudes);
    }

    public function getColaLibre(): string
    {
        return $this->colaMasCorta();
    }

}
