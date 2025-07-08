<?php
function analyseerMetAI($tekst) {
    $apiUrl = "http://localhost:3000/api/analyseer";
    $postData = ['tekst' => $tekst];
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'x-api-key: JouwSterkeApiToken123!'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$result = analyseerMetAI('Jouw testtekst');

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

