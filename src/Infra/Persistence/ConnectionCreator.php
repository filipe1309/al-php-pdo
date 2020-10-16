<?php

namespace Alura\Pdo\Infra\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {        
        $caminhaBanco = __DIR__ . '/../../../banco.sqlite';
        $connection = new PDO('sqlite:' . $caminhaBanco);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}