<?php

namespace App\Services;

use App\Jobs\CrudJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ColaAction
{
    public function encolar(string $serviceClass, string $metodo, ...$params)
    {
        $uuid = Str::uuid()->toString();

        CrudJob::dispatch($serviceClass, $metodo, $params, $uuid);

        Cache::put("t:$uuid", "procesando", 60);

        return response()->json([
            'message' => 'Operacion en proceso',
            'url' => url("api/estado/$uuid"),
            'transaction_id' => $uuid,
            'status' => 'procesando'
        ], 202);
    }
}