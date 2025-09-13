<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    protected $table = 'jobs_status';

    protected $keyType = 'string';   
    public $incrementing = false;

    protected $fillable = [
        'id',
        'status',
        'result',
    ];

    protected $casts = [
        'result' => 'array', // para que al acceder a result lo devuelva como array
    ];
}