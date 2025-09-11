<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Jobs\StoreJob;

trait StoreTrait
{
    // protected string $modelo;

    public function store(Request $request)
    {
        $uuid = (string) Str::uuid();

        StoreJob::dispatch($this->modelo, $request->all(), $uuid);

        Cache::put("t:$uuid", "en_proceso", 1800);

        return response()->json([
            'message' => class_basename($this->modelo) . ' en proceso de creación',
            'url' => url("api/estado/$uuid"),
            'transaction_id' => $uuid,
            'status' => 'en_proceso'
        ], 202);
    }
}
