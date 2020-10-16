<?php

$caminhaBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhaBanco);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
echo 'Connected: ' . $caminhaBanco . PHP_EOL;

$pdo->exec("INSERT INTO phones (area_code, number, student_id) VALUES ('41', '999999999', 1);");
echo 'Created' . PHP_EOL;

exit();

$createTableSql = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        name TEXT,
        birth_date TEXT
    );
    
    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        area_code TEXT,
        number TEXT,
        student_id INTEGER,
        FOREIGN KEY (student_id) REFERENCES students(id)
    );
';
$pdo->exec($createTableSql);

echo 'Created' . PHP_EOL;