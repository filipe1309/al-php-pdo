<?php

namespace Alura\Pdo\Infra\Repository;

use PDO;
use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Domain\Model\student;
use Alura\Pdo\Infra\Persistence\ConnectionCreator;
use Alura\Pdo\Domain\Repository\StudentRepository;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $sqlQuery = 'SELECT * FROM students;';
        $stmt = $this->connection->query($sqlQuery);
        
        return $this->hydrateStudentList($stmt);
    }
    
    public function studentBirthAt(\DateTimeInterface $birthDate): array
    {
        $sqlQuery = "SELECT * FROM students WHERE birth_date = ?;";
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $birthDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudentList($stmt);
    }

    public function hydrateStudentList($stmt)
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $student = new Student($studentData['id'], $studentData['name'], new \DateTimeImmutable($studentData['birth_date']));
            $this->fillPhonesOf($student);
            $studentList[] = $student;
        }

        return $studentList;
    }

    private function fillPhonesOf(Student $student): void
    {
        $sqlQuery = 'SELECT id, area_code, number FROM phones WHERE student_id = ?';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
        $stmt->execute();

        $phoneDataList = $stmt->fetchAll();
        foreach ($phoneDataList as $phoneData) {
            $phone = new Phone(
                $phoneData['id'],
                $phoneData['area_code'],
                $phoneData['number'],
            );

            $student->addPhone($phone);
        }
    }
    
    public function save(Student $student): bool
    {
        if (is_null($student->id())) {
            return $this->insert($student);
        }

        return $this->update($student);
    }

    public function insert(Student $student): bool
    {
        $sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
        $statement = $this->connection->prepare($sqlInsert);

        $result = $statement->execute([
            'name' => $student->name(),
            'birth_date' => $student->birthDate()->format('Y-m-d')
        ]);

        if ($result) {
            $student->defineId($this->connection->lastInsertId());
        }

        return $result;
    }

    public function update(Student $student): bool
    {
        $sqlUpdate = "UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;";
        $stmt = $this->connection->prepare($sqlUpdate);
        $stmt->bindValue('name', $student->name()); 
        $stmt->bindValue('birth_date', $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue('id', $student->id(), PDO::PARAM_INT); 

        return $stmt->execute();
    }
    
    public function remove(Student $student): bool
    {
        $sqlDelete = "DELETE FROM students WHERE id = ?;";
        $statement = $this->connection->prepare($sqlDelete);
        $statement->bindValue(1, $student->id(), PDO::PARAM_INT); 
        
        return $statement->execute();
    }
}