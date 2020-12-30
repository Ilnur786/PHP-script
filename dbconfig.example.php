<?php
$user = $_ENV['USER'];
$pass = $_ENV['PASS'];
$host = $_ENV['HOST'];
$dbname = $_ENV['DB_NAME'];

//$url = getenv('JAWSDB_URL');
//$dbparts = parse_url($url);
//
//$host = $dbparts['host'];
//$user = $dbparts['user'];
//$pass = $dbparts['pass'];
//$dbname = ltrim($dbparts['path'],'/');

$dsn = "mysql:host={$host};dbname={$dbname}";