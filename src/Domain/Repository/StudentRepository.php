<?php

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Model\student;

interface StudentRepository
{
    public function allStudents(): array;
    public function studentBirthAt(\DateTimeInterface $birthDate): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;
}