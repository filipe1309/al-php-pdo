<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;
use Alura\Pdo\Infra\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($pdo);
$studentList = $repository->allStudents();

var_dump($studentList);


// $statement = $pdo->query('SELECT * FROM students;');
// $studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
// var_dump($statement->fetchColumn(1)); exit();
// var_dump($statement->fetchAll(PDO::FETCH_CLASS, Student::class));

// Economiza memoria
// while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
//     $student = new Student($studentData['id'], $studentData['name'], new DateTimeImmutable($studentData['birth_date']));
//     echo $student->age() . PHP_EOL;
// }
// exit();

// $studentList = [];
// foreach ($studentDataList as $studentData) {
//     $studentList[] = new Student($studentData['id'], $studentData['name'], new DateTimeImmutable($studentData['birth_date']));
// }

// var_dump($studentList);
