<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EstadoController extends Controller
{
    public function consultarEstado($uuid)
    {
        $status = Cache::get("t:$uuid");

        if (!$status) {
            return response()->json([
                'status' => 'procesado'
            ]);
        }

        return response()->json([
            'status' => $status
        ]);
    }
}
