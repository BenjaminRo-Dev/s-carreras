<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    protected $fillable = ['sigla', 'nombre', 'cupo', 'materia_id', 'docente_id', 'gestion_id'];

    // Un grupo pertenece a una materia
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    // Un grupo pertenece a un docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    // Un grupo pertenece a una gestión
    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_id');
    }

    // Un grupo puede tener muchos horarios
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'grupo_id');
    }

    // Un grupo puede tener muchos estudiantes
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'materia_estudiante')
            ->withPivot('nota', 'creditos', 'materia_id')
            ->withTimestamps();
    }
}
