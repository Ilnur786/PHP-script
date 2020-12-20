<?php
//$dbConfig = include_once ROOT . '/config/dbConfig.php';

$dsn = "mysql:host=localhost;dbname=test";
$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}