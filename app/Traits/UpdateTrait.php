<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Jobs\UpdateJob;

trait UpdateTrait
{
    public function update(Request $request, $id)
    {
        $uuid = (string) Str::uuid();

        UpdateJob::dispatch($this->modelo, $id, $request->all(), $uuid);

        Cache::put("t:$uuid", "en_proceso", 1800);

        return response()->json([
            'message' => class_basename($this->modelo) . ' en proceso de actualización',
            'url' => url("api/estado/$uuid"),
            'transaction_id' => $uuid,
            'status' => 'en_proceso'
        ], 202);
    }
}
