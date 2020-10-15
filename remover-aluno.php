<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$caminhaBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhaBanco);

$sqlDelete = "DELETE FROM students WHERE id = ?;";
$statement = $pdo->prepare($sqlDelete);
$statement->bindValue(1, 3, PDO::PARAM_INT); 

var_dump($statement->execute());
