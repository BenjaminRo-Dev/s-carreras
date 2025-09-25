<?php

namespace App\Console\Commands;

use App\Services\RabbitMQService;
use Illuminate\Console\Command;

class EscalarWorkersSup extends Command
{
    protected $signature = 'workers:escala';
    protected $description = 'Escala el número de workers basándose en la longitud de las colas';

    protected static $maxProcesos = 5;

    public function __construct(protected RabbitMQService $rabbitMQService)
    {
        parent::__construct();
    }

    public function handle()
    {
        $colas = $this->rabbitMQService->getLongitudesColas();

        if (empty($colas)) {
            $this->info("No se detectaron colas.");
            return Command::SUCCESS;
        }

        $estadoAnterior = $this->obtenerEstadoAnterior();

        $estadoNuevo = [];
        foreach ($colas as $cola => $pendientes) {
            $estadoNuevo[$cola] = match (true) {
                $pendientes > 1000 => 3,
                $pendientes > 500 => 2,
                $pendientes > 0 => 1,
                default => 0,
            };
        }

        if ($estadoNuevo !== $estadoAnterior) {
            $this->generarSupervisorConf(array_keys($colas));

            $conf = '/var/www/html/docker/supervisord.conf';
            exec("supervisorctl -c {$conf} reread");
            exec("supervisorctl -c {$conf} update");

            foreach ($estadoNuevo as $cola => $workersNecesarios) {
                $this->escalarSupervisor("laravel-cola-{$cola}", $workersNecesarios);
                $this->info("Cola: {$cola} - Pendientes: {$colas[$cola]} - Workers: {$workersNecesarios}");
            }

            $this->guardarEstado($estadoNuevo);
        } else {
            $this->info("No hubo cambios en las colas, no se regeneró el archivo.");
        }

        return Command::SUCCESS;
    }

    protected function generarSupervisorConf(array $colas)
    {
        $rutaBase = '/var/www/html/docker/supervisord.base.conf';
        $rutaConf = '/var/www/html/docker/supervisord.conf';

        if (!file_exists($rutaBase)) {
            $this->error("No se encontró el archivo base: {$rutaBase}");
            return;
        }

        $base = trim(file_get_contents($rutaBase));

        $procesos = "";
        foreach ($colas as $cola) {
            $procesos .= "\n\n[program:laravel-cola-{$cola}]\n";
            $procesos .= "process_name=%(process_num)d\n";
            $procesos .= "command=php /var/www/html/artisan queue:work rabbitmq --queue={$cola} --sleep=3 --tries=3\n";
            $procesos .= "autostart=false\n";
            $procesos .= "autorestart=true\n";
            $procesos .= "user=sail\n";
            $procesos .= "numprocs=" . self::$maxProcesos . "\n";
            $procesos .= "redirect_stderr=true\n";
            $procesos .= "stdout_logfile=/var/log/supervisor/laravel-cola-{$cola}.log\n";
        }

        $confFinal = $base . "\n" . $procesos;

        if (file_put_contents($rutaConf, $confFinal) === false) {
            $this->error("Error escribiendo el archivo: {$rutaConf}");
            return;
        }

        $this->info("Archivo supervisord.conf generado para las colas: " . implode(', ', $colas));
    }

    protected function escalarSupervisor(string $proceso, int $numWorkers)
    {
        $conf = '/var/www/html/docker/supervisord.conf';

        exec("supervisorctl -c {$conf} stop {$proceso}:*");

        for ($i = 0; $i < $numWorkers; $i++) {
            exec("supervisorctl -c {$conf} start {$proceso}:{$i}");
        }
    }

    protected function obtenerEstadoAnterior(): array
    {
        $archivo = '/var/www/html/docker/estado_workers.json';
        if (!file_exists($archivo)) {
            return [];
        }
        return json_decode(file_get_contents($archivo), true) ?? [];
    }

    protected function guardarEstado(array $estado)
    {
        $archivo = '/var/www/html/docker/estado_workers.json';
        file_put_contents($archivo, json_encode($estado));
    }
}
