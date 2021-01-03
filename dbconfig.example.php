<?php
$url = getenv('JAWSDB_MARIA_URL');
$dbparts = parse_url($url);

$host = $dbparts['host'];
$user = $dbparts['user'];
$pass = $dbparts['pass'];
$dbname = ltrim($dbparts['path'],'/');

$dsn = "mysql:host={$host};dbname={$dbname}";