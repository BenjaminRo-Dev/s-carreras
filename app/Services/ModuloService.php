<?php

namespace App\Services;

use App\Models\Modulo;

class ModuloService
{
    public function mostrar($id)
    {
        return Modulo::with('aulas')->findOrFail($id);
    }

    public function mostrarTodos()
    {
        return Modulo::with('aulas')->get();
    }

    public function guardar(array $datos)
    {
        $modulo = new Modulo($datos);
        $modulo->save();

        for ($i = 0; $i < $datos['cant_aulas']; $i++) {
            $modulo->aulas()->create([
                'numero' => $i + 1,
            ]);
        }

        return $modulo;
    }

    public function actualizar(array $datos, $id)
    {
        $modulo = Modulo::findOrFail($id);
        $modulo->update($datos);

        if (isset($datos['cant_aulas'])) {
            $modulo->aulas()->delete();
            for ($i = 0; $i < $datos['cant_aulas']; $i++) {
                $modulo->aulas()->create([
                    'numero' => $i + 1,
                    // 'modulo_id' => $modulo->id
                ]);
            }
        }

        return $modulo;
    }

    public function eliminar($id)
    {
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();
        return response()->json(['message' => 'Modulo ' . $modulo->numero . ' eliminado.']);
    }
}
