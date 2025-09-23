<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class EscalarWorkers extends Command
{
    // protected $signature = 'app:escalar-workers';
    
    protected $signature = 'workers:escalar';
    protected $description = 'Escala el número de workers basándose en la longitud de las colas';

    protected string $host;
    protected string $user;
    protected string $password;
    protected array $colas;

    public function __construct()
    {
        parent::__construct();

        $this->host = config('queue.connections.rabbitmq.management.host');
        $this->user = config('queue.connections.rabbitmq.management.user');
        $this->password = config('queue.connections.rabbitmq.management.password');
        $this->colas = explode(',', config('queue.connections.rabbitmq.queues'));
    }

    public function handle()
    {
        $respuesta = Http::withBasicAuth($this->user, $this->password)
            ->get("{$this->host}/api/queues");
        
        if ($respuesta->failed()){
            $this->error("No se pudo conectar con la API de RabbitMQ");
            return Command::FAILURE;
        }

        $infoColas = $respuesta->json();

        foreach ($infoColas as $cola) {
            if(!in_array($cola['name'], $this->colas)){
                continue;
            }

            $pendientes = $cola['messages_ready'] ?? 0;
            $necesarios = match (true) {
                $pendientes > 10 => 3,
                $pendientes > 5 => 2,
                default => 1,
            };

            $programa = "laravel-{$cola['name']}";
            $this->escalarSupervisor($programa, $necesarios);

            $this->info("Cola: {$cola['name']} - Pendientes: $pendientes - Workers: $necesarios");

        }
        return Command::SUCCESS;
    }

    protected function escalarSupervisor(string $programa, int $numWorkers)
    {
        $conf = '/var/www/html/docker/supervisord.conf';

        // Primero detenemos todos los workers de ese programa
        exec("supervisorctl -c {$conf} stop {$programa}:*");

        // Arrancamos solo los necesarios
        for ($i = 0; $i < $numWorkers; $i++) {
            exec("supervisorctl -c {$conf} start {$programa}:{$i}");
        }



        // $comando = "sudo supervisorctl reread && sudo supervisorctl update && sudo supervisorctl scale {$programa}={$numWorkers}";
        // exec($comando, $output, $returnVar);

        // if ($returnVar !== 0) {
        //     $this->error("Error al escalar el programa $programa");
        // }
    }
}
