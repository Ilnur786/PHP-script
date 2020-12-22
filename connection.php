<?php
include_once 'dbсonfig.php';

$dsn = "mysql:host=localhost;dbname=test";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}