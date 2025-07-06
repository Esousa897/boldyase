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

// --- AI-advies ophalen via Node.js API ---
$apiUrl = "http://localhost:3000/api/suggestie";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'x-api-key: JouwSterkeApiToken123!' // Zet hier exact jouw AUTH_TOKEN!
]);
$response = curl_exec($ch);

if ($response === false) {
    echo "<div style='color:red'><b>Fout bij API-call:</b> " . curl_error($ch) . "</div>";
} else {
    $data = json_decode($response, true);
    if (isset($data['advies'])) {
        echo "<div style='margin-bottom:16px;'><b>AI-advies:</b> " . htmlspecialchars($data['advies']) . "</div>";
    } elseif (isset($data['error'])) {
        echo "<div style='color:red'><b>API-fout:</b> " . htmlspecialchars($data['error']) . "</div>";
    } else {
        echo "<div style='color:orange'>Onbekend API-resultaat.</div>";
    }
}
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Test Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .dashboard { background: #f9f9f9; padding: 30px; border-radius: 8px; width: 600px; }
        .stats { margin-top: 20px; }
        .stat { margin-bottom: 8px; }
        .user-info { font-size: 1.1em; margin-bottom: 16px; }
        .notificatie { background: #e6ffe6; padding: 8px; border-radius: 4px; margin-bottom: 10px;}
    </style>
</head>
<body>
    <div class="dashboard">
        <?php include __DIR__ . '/../includes/components/dashboard-header.php'; ?>
        <?php include __DIR__ . '/../includes/components/dashboard-notificaties.php'; ?>
        <?php include __DIR__ . '/../includes/components/dashboard-stats.php'; ?>
        <?php include __DIR__ . '/../includes/components/dashboard-performance.php'; ?>
