<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/ai_api.php';

$result = analyseerMetAI('Tekst vanuit het dashboard');
print_r($result);

// ...rest van je upload-code...