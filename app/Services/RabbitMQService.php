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

    public function existeCola(string $nombreCola): bool
    {
        $colas = $this->getInfoColas();
        return isset($colas[$nombreCola]);
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

    public function crearCola(string $queueName, string $vhost = '/', array $params = []): bool
    {
        $url = "{$this->host}/api/queues/" . urlencode($vhost) . "/" . urlencode($queueName);

        $body = array_merge([
            'auto_delete' => false,
            'durable' => true,
            'arguments' => new \stdClass()
        ], $params);

        $respuesta = Http::withBasicAuth($this->user, $this->password)
            ->timeout(30)
            ->put($url, $body);

        if ($respuesta->failed()) {
            Log::error('Error creando cola en RabbitMQ', [
                'status' => $respuesta->status(),
                'error' => $respuesta->body()
            ]);
            throw new \Exception("No se pudo crear la cola: " . $respuesta->status());
        }

        return true;
    }

}
