<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

class EscalarWorkers extends Command
{
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
            
            $programa = "laravel-cola-{$cola['name']}";
            $this->escalarSupervisor($programa, $necesarios);

            $this->info("Cola: {$cola['name']} - Pendientes: $pendientes - Workers: $necesarios");

        }
        return Command::SUCCESS;
    }

    protected function escalarSupervisor(string $programa, int $numWorkers)
    {
        $conf = '/var/www/html/docker/supervisord.conf';

        exec("supervisorctl -c {$conf} stop {$programa}:*");

        for ($i = 0; $i < $numWorkers; $i++) {
            exec("supervisorctl -c {$conf} start {$programa}:0{$i}");
        }
    }


            //Para depurar dentro del for:
            // $uuid = Str::uuid();
            // Cache::put("escalar:$uuid", "supervisorctl -c {$conf} start {$programa}:0{$i}", config('cache.tiempo_cache_error'));
        
            // Cache::put("escalar:$uuid:$i", [
            //     'cmd' => "supervisorctl -c {$conf} start {$programa}:0{$i}",
            //     'output' => $output,
            //     'status' => $returnVar,
            // ], config('cache.tiempo_cache_error'));  
}
