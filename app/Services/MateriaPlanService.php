<?php

namespace App\Services;

use App\Models\MateriaPlan;
use Illuminate\Support\Facades\Log;

class MateriaPlanService
{
    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para materia plan: $id");
        return MateriaPlan::where('id', $id)->delete();
    }
}
