<?php

$caminhaBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhaBanco);

echo 'conn: ' . $caminhaBanco . PHP_EOL;

$pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);');

echo 'created' . PHP_EOL;