<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/ai_api.php';
// Voeg extra requires toe voor components/layout indien nodig

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- Voorbeeldcontent / test ---
echo "<h1>BOLDYASE Portaal</h1>";

// Voorbeeld AI-analyse tonen
$resultaat = analyseerMetAI('Welkom bij BOLDYASE! Minimaliseer & optimaliseer.');
echo "<pre>";
print_r($resultaat);
echo "</pre>";

// Voeg hier je eigen componenten, logica, HTML