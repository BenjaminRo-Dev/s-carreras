<?php

namespace App\Gestor;

use Illuminate\Support\Facades\Http;

class RabbitAction
{
    protected string $host;
    protected string $user;
    protected string $password;
    protected array $colas;

    public function __construct()
    {
        $this->host = config('queue.connections.rabbitmq.management.host');
        $this->user = config('queue.connections.rabbitmq.management.user');
        $this->password = config('queue.connections.rabbitmq.management.password');
        $this->colas = explode(',', config('queue.connections.rabbitmq.queues'));
    }

    protected function getLongitudesColas(): array
    {
        $respuesta = Http::withBasicAuth($this->user, $this->password)
            ->get("{$this->host}/api/queues");

        $longitudes = [];

        foreach ($respuesta->json() as $cola) {
            if (in_array($cola['name'], $this->colas)) {
                $longitudes[$cola['name']] = $cola['messages_ready'] ?? 0;
            }
        }

        return $longitudes;
    }

    protected function colaMasCorta(): string
    {
        $longitudes = $this->getLongitudesColas();
        
        // Si no hay colas disponibles, retornar la primera cola configurada
        if (empty($longitudes)) {
            return $this->colas[0] ?? 'default';
        }
        
        asort($longitudes); // ordenar de menor a mayor
        return array_key_first($longitudes);
    }

    public function getColaLibre(): string
    {
        return $this->colaMasCorta();
    }

}
