<?php

namespace App\Traits;

use App\Jobs\DestroyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait DestroyTrait
{
    public function destroy(Request $request, $id)
    {
        $uuid = (string) Str::uuid();

        DestroyJob::dispatch($this->modelo, $id, $uuid);

        Cache::put("t:$uuid", "en_proceso", 1800);

        return response()->json([
            'message' => class_basename($this->modelo) . ' en proceso de eliminacion',
            'url' => url("api/estado/$uuid"),
            'transaction_id' => $uuid,
            'status' => 'en_proceso'
        ], 202);
    }
}
