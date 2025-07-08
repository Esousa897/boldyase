<?php
$apiUrl = "http://localhost:3000/api/analyseer";
$postData = ['tekst' => 'Testtekst voor AI-analyse vanuit BOLDYASE-dashboard!'];

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'x-api-key: JouwSterkeApiToken123!' // Zet exact jouw AUTH_TOKEN!
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
$response = curl_exec($ch);

if ($response === false) {
    echo "Fout bij API-call: " . curl_error($ch);
} else {
    $data = json_decode($response, true);
    if (isset($data['resultaat'])) {
        echo "<b>AI-resultaat:</b> " . htmlspecialchars($data['resultaat']);
    } elseif (isset($data['error'])) {
        echo "<b>API-fout:</b> " . htmlspecialchars($data['error']);
    } else {
        echo "Onbekend API-resultaat.";
    }
}
curl_close($ch);
?>
