<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

// Test of de Dotenv\Dotenv class
var_dump(class_exists('Dotenv\Dotenv')); 
exit;

// Laad .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

echo "<h2>.env TEST</h2>";

echo "<pre>";
echo "DB_HOST: " . getenv('DB_HOST') . "\n";
echo "DB_NAME: " . getenv('DB_NAME') . "\n";
echo "ENVIRONMENT: " . getenv('ENVIRONMENT') . "\n";
echo "DEBUG: " . getenv('DEBUG') . "\n";
echo "</pre>";

// Debugfunctie voor omgeving
$environment = getenv('ENVIRONMENT');

if ($environment === 'development') {
    echo "<p style='color:green;'>Development mode actief</p>";
} elseif ($environment === 'production') {
    echo "<p style='color:red;'>Production mode actief</p>";
} else {
    echo "<p style='color:orange;'>Onbekende omgeving!</p>";
}
?>
