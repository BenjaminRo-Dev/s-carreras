<?php

namespace App\Services;

use App\Jobs\CrudJob;
use App\Jobs\CrudLoteJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ColaAction
{
    public function encolar(string $serviceClass, string $metodo, $cola = "default", ...$params)
    {
        $uuid = Str::uuid()->toString();

        CrudJob::dispatch($serviceClass, $metodo, $params, $uuid)->onQueue($cola);

        Cache::put("t:$uuid", "procesando", config('cache.tiempo_cache'));

        return response()->json([
            'message' => 'Operacion en proceso',
            'url' => url("api/estado/$uuid"),
            'transaction_id' => $uuid,
            'status' => 'procesando'
        ], 202);
    }

    protected int $tamLote = 10;
    protected string $cacheKey = 'cola_lote';

    public function encolarLote(string $serviceClass, string $metodo, ...$params)
    {
        Redis::rpush($this->cacheKey, json_encode([
            'serviceClass' => $serviceClass,
            'metodo' => $metodo,
            'params' => $params
        ]));
        
        $conteo = Redis::llen($this->cacheKey);
        
        if ($conteo >= $this->tamLote) {
            $loteSolicitudesJson = Redis::lrange($this->cacheKey, 0, -1);
            
            $loteSolicitudes = array_map(function($item) {
                return json_decode($item, true);
            }, $loteSolicitudesJson);
            
            Redis::del($this->cacheKey);
            
            CrudLoteJob::dispatch($loteSolicitudes);
            
            return response()->json([
                'message' => "Se ha enviado un lote de {$conteo} peticiones a la cola.",
                'status' => 'lote_enviado'
            ], 202);
        }

        return response()->json([
            'message' => "Petición en espera. Lote actual: {$conteo}/{$this->tamLote}",
            'status' => 'en_espera'
        ], 202);
    }

}