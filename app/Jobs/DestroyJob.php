<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Throwable;

use function Illuminate\Log\log;

class DestroyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $modelo;
    protected int $id;
    protected string $uuid;
    public $tries = 3;

    public function __construct(string $modelo, int $id, string $uuid)
    {
        $this->modelo = $modelo;
        $this->id = $id;
        $this->uuid = $uuid;
    }

    public function handle(): void
    {
        try {
            $this->modelo::destroy($this->id);
            Cache::forget("t:{$this->uuid}");
        } catch (Throwable $e) {
            Cache::put("t:{$this->uuid}", "fallido", 3600);
        }
    }
}
