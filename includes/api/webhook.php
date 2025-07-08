<?php
function analyseerMetAI($tekst) {
    $apiUrl = "http://localhost:3000/api/analyseer";
    $postData = ['tekst' => $tekst];
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'x-api-key: JouwSterkeApiToken123!' // Zet hier je eigen API-key!
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>
