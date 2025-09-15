<?php

namespace App\Services;

use App\Jobs\CrudJob;
use Illuminate\Support\Facades\Cache;
use App\Helpers\TransactionHelper;

class ColaAction
{
    public function encolar(string $serviceClass, string $metodo, ...$params)
    {
        // Obtenemos el uuid
        $uuid = TransactionHelper::generarIdTransaccion([
            'servicio' => $serviceClass,
            'metodo'  => $metodo,
            'params'  => $params,
        ]);

        // Revisar en cache si ya existe
        $txn = Cache::get("t:$$uuid");

        if ($txn && $txn['status'] === 'procesado') {
            return response()->json([
                'message' => 'Operacion ya procesada',
                'status'  => 'exito',
                'result'  => $txn['result'],
                'transaction_id' => $uuid,
            ], 200);
        }

        if ($txn && $txn['status'] === 'procesando') {
            return response()->json([
                'message' => 'Operación en proceso',
                'status'  => 'procesando',
                'url'     => url("api/estado/{$txn['uuid']}"),
                'transaction_id' => $uuid,
            ], 202);
        }

        // Si no existe, crear un nuevo registro

        // Encolar job en RabbitMQ
        CrudJob::dispatch($serviceClass, $metodo, $params, $uuid);

        // Guardar en cache como "procesando"
        Cache::put("t:$uuid", [
            'status' => 'procesando',
            'params' => $params,
        ], now()->addMinutes(30));

        // Endpoint de estado
        return response()->json([
            'message' => 'Operación en proceso',
            'url'     => url("api/estado/$uuid"),
            'transaction_id' => $uuid,
            'status' => 'procesando'
        ], 202);
    }
}
