<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return response()->json(['message' => 'Hola tópicos Postgres']);
});
