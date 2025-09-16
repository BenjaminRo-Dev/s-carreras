<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected bool $usarCola;

    public function __construct()
    {
        $this->usarCola = config('app.usar_cola', true);
    }
}
