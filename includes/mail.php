<?php
// filepath: c:\MAMP\htdocs\boldyase\includes\mail.php

// Databaseconnectie voor BOLDYASE (MAMP)
$host = 'localhost';
$db   = 'boldyase_db';
$user = 'root';
$pass = 'root';
$port = 3307;

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Database connectie mislukt: ' . $e->getMessage());
}