<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infra\Repository\PdoStudentRepository;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

// cria turma
$connection->beginTransaction();
$aStudent = new Student(null, 'Elvis Presley', new \DateTimeImmutable('1985-05-01'));
$studentRepository->save($aStudent);


$anotherStudent = new Student(null, 'Paul Mc', new \DateTimeImmutable('1985-05-01'));
$studentRepository->save($anotherStudent);

$connection->commit();

// insere alunos