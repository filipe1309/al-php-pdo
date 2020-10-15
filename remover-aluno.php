<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$sqlDelete = "DELETE FROM students WHERE id = ?;";
$statement = $pdo->prepare($sqlDelete);
$statement->bindValue(1, 3, PDO::PARAM_INT); 

var_dump($statement->execute());
