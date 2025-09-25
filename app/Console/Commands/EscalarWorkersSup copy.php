<?php
//NOTA: NO ESTOY USANDO ESTE ARCHIVO, LO DEJO SOLO COMO REFERENCIA DE LA VERSION ANTERIOR
//ESTA VERSION ESCALA PERO TODO EL TIEMPO DETIENE Y VUELVE A CREAR LOS PROCESOS Y REESCRIBIR EN EL ARCHIVO
namespace App\Console\Commands;

use App\Services\RabbitMQService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class EscalarWorkersSup extends Command
{

    // protected $signature = 'workers:escala';
    // protected $description = 'Escala el número de workers basándose en la longitud de las colas';

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

        $this->generarSupervisorConf(array_keys($colas));

        $conf = '/var/www/html/docker/supervisord.conf';
        exec("supervisorctl -c {$conf} reread");
        exec("supervisorctl -c {$conf} update");

        foreach ($colas as $cola => $pendientes) {
            $necesarios = match (true) {
                $pendientes > 1000 => 3,
                $pendientes > 500 => 2,
                $pendientes > 0 => 1,
                default => 0,
            };

            $proceso = "laravel-cola-{$cola}";
            $this->escalarSupervisor($proceso, $necesarios);

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

        $procesos = "";
        foreach ($colas as $cola) {
            $procesos .= "\n\n[program:laravel-cola-{$cola}]\n";
            $procesos .= "process_name=%(process_num)02d\n";
            $procesos .= "command=php /var/www/html/artisan queue:work rabbitmq --queue={$cola} --sleep=3 --tries=3\n";
            $procesos .= "autostart=false\n";
            $procesos .= "autorestart=true\n";
            $procesos .= "user=sail\n";
            $procesos .= "numprocs=5\n";
            $procesos .= "redirect_stderr=true\n";
            $procesos .= "stdout_logfile=/var/log/supervisor/laravel-cola-{$cola}.log\n";
        }

        // Concatenar base + procesos
        $confFinal = $base . "\n" . $procesos;

        // Guardar el archivo
        if (file_put_contents($confPath, $confFinal) === false) {
            $this->error("Error escribiendo el archivo: {$confPath}");
            return;
        }

        $this->info("Archivo supervisord.conf generado para las colas: " . implode(', ', $colas));
    }

    protected function escalarSupervisor(string $proceso, int $numWorkers)
    {
        $conf = '/var/www/html/docker/supervisord.conf';

        // Detener todos los procesos existentes
        exec("supervisorctl -c {$conf} stop {$proceso}:*");

        // Iniciar los necesarios
        for ($i = 0; $i < $numWorkers; $i++) {
            exec("supervisorctl -c {$conf} start {$proceso}:0{$i}");
        }
    }
}
