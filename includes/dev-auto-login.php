<?php
session_start();

// Alleen automatisch inloggen als je lokaal werkt
if (
    // Check op localhost of 127.0.0.1
    $_SERVER['SERVER_NAME'] === 'localhost' ||
    $_SERVER['SERVER_ADDR'] === '127.0.0.1'
) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] = 1; // test user ID
        $_SESSION['username'] = 'testgebruiker';
    }
}

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
?>
