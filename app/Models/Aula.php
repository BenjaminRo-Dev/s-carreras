<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aulas';
    protected $fillable = ['numero', 'modulo_id'];

    // Un aula puede tener muchos horarios
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'aula_id');
    }
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}
