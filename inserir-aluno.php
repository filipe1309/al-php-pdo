<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$caminhaBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhaBanco);

$student = new Student(null, 'Bob Dylan 3', new \DateTimeImmutable('1997-10-15'));


// $sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?, ?);";
// $statement = $pdo->prepare($sqlInsert);
// $statement->bindValue(1, $student->name());
// $statement->bindValue(2, $student->birthDate()->format('Y-m-d'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue('name', $student->name()); 
$statement->bindValue('birth_date', $student->birthDate()->format('Y-m-d'));

if ($statement->execute()) {
    echo 'Aluno incluido' . PHP_EOL;
}
