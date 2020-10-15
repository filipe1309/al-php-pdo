<?php

namespace Alura\Pdo\Infra\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {        
        $caminhaBanco = __DIR__ . '/../../../banco.sqlite';
        return new PDO('sqlite:' . $caminhaBanco);
    }
}