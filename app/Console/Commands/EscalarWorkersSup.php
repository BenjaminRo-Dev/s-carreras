<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

class EscalarWorkersSup extends Command
{
    
    protected $signature = 'workers:escala';
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

        if ($respuesta->failed()) {
            $this->error("No se pudo conectar con la API de RabbitMQ");
            return Command::FAILURE;
        }

        $infoColas = $respuesta->json();

        $colasDetectadas = [];
        $pendientesPorCola = [];

        foreach ($infoColas as $cola) {
            if (!in_array($cola['name'], $this->colas)) continue;

            $pendientes = $cola['messages_ready'] ?? 0;
            $pendientesPorCola[$cola['name']] = $pendientes;
            $colasDetectadas[] = $cola['name'];
        }

        if (empty($colasDetectadas)) {
            $this->info("No se detectaron colas configuradas.");
            return Command::SUCCESS;
        }

        $this->generarSupervisorConf($colasDetectadas);

        $conf = '/var/www/html/docker/supervisord.conf';
        exec("supervisorctl -c {$conf} reread");
        exec("supervisorctl -c {$conf} update");

        foreach ($pendientesPorCola as $cola => $pendientes) {
            $necesarios = match (true) {
                $pendientes > 1000 => 3,
                $pendientes > 500 => 2,
                $pendientes > 0 => 1,
                default => 0,
            };

            $programa = "laravel-cola-{$cola}";
            $this->escalarSupervisor($programa, $necesarios);

            $this->info("Cola: {$cola} - Pendientes: $pendientes - Workers: $necesarios");
        }

        return Command::SUCCESS;
    }

    protected function generarSupervisorConf(array $colas)
    {
        $basePath = '/var/www/html/docker/supervisord.base.conf';
        $confPath = '/var/www/html/docker/supervisord.conf';

        if (!file_exists($basePath)) {
            $this->error("No se encontró el archivo base: {$basePath}");
            return;
        }
        $base = file_get_contents($basePath);
        $base = trim($base);

        $programs = "";
        foreach ($colas as $cola) {
            $programs .= "\n\n[program:laravel-cola-{$cola}]\n";
            $programs .= "process_name=%(process_num)02d\n";
            $programs .= "command=php /var/www/html/artisan queue:work rabbitmq --queue={$cola} --sleep=3 --tries=3\n";
            $programs .= "autostart=false\n";
            $programs .= "autorestart=true\n";
            $programs .= "user=sail\n";
            $programs .= "numprocs=5\n";
            $programs .= "redirect_stderr=true\n";
            $programs .= "stdout_logfile=/var/log/supervisor/laravel-cola-{$cola}.log\n";
        }

        $confFinal = $base . "\n" . $programs;

        if (file_put_contents($confPath, $confFinal) === false) {
            $this->error("Error escribiendo el archivo: {$confPath}");
            return;
        }

        $this->info("Archivo supervisord.conf generado correctamente para las colas: " . implode(', ', $colas));
    }


    protected function escalarSupervisor(string $programa, int $numWorkers)
    {
        $conf = '/var/www/html/docker/supervisord.conf';

        exec("supervisorctl -c {$conf} stop {$programa}:*");

        for ($i = 0; $i < $numWorkers; $i++) {
            exec("supervisorctl -c {$conf} start {$programa}:0{$i}");
        }
    }
}