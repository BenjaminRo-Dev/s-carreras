<?php

namespace App\Services;

use App\Models\Horario;
use Illuminate\Support\Facades\Log;

class HorarioService
{
    public function guardar(array $horario)
    {
        return Horario::create($horario);
    }

    public function mostrar(string $id)
    {
        return Horario::with(['grupo', 'aula', 'modulo'])->findOrFail($id);
    }

    public function mostrarTodos()
    {
        Log::info("Ejecutando mostrarTodos para horario");
        return Horario::with(['grupo', 'aula', 'modulo'])->get();
    }

    public function actualizar(string $id, array $datos)
    {
        Log::info("Ejecutando actualizar para horario: $id", $datos);
        return Horario::where('id', $id)->update($datos);
    }

    public function eliminar(string $id)
    {
        Log::info("Ejecutando eliminar para horario: $id");
        return Horario::where('id', $id)->delete();
    }
}
