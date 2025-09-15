<?php

namespace App\Helpers;

class TransactionHelper
{
    public static function generarIdTransaccion(array $data): string
    {
        ksort($data); // ordenar siempre igual
        return md5(json_encode($data)); // clave única
    }
}
