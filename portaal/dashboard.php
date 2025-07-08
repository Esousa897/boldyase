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
    <title>BOLDYASE Portaal Dashboard</title>
    <meta name="viewport" content="width=1280, initial-scale=1">
    <style>
        body {
            background: #F8F5F2;
            color: #2D3033;
            font-family: 'Neue Haas Grotesk', Arial, sans-serif;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .dashboard-nav {
            width: 180px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border-radius: 8px;
            padding: 24px 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .dashboard-nav ul {
            list-style: none;
            padding: 0;
            margin: 0 0 40px 0;
        }

        .dashboard-nav li {
            margin-bottom: 20px;
        }

        .dashboard-nav a {
            text-decoration: none;
            color: #2D3033;
            font-size: 17px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dashboard-nav .nav-bottom {
            text-align: center;
        }

        .dashboard-main {
            flex: 1;
            padding: 32px 24px 80px 24px;
        }

        .dashboard-sidebar {
            width: 340px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            margin-left: 24px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Logo rechtsboven */
        .dashboard-logo {
            position: fixed;
            top: 32px;
            right: 42px;
            z-index: 9999;
            text-align: center;
            background: none;
        }

        .dashboard-logo img {
            max-width: 90px;
            height: auto;
            display: block;
            margin: 0 auto 6px auto;
            background: transparent;
        }

        .dashboard-logo .studio {
            font-size: 17px;
            letter-spacing: 2.2px;
            font-weight: 700;
            color: #2D3033;
            opacity: 0.82;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .dashboard-logo {
                top: 10px;
                right: 10px;
            }

            .dashboard-logo img {
                max-width: 64px;
            }

            .dashboard-logo .studio {
                font-size: 14px;
            }
        }

        /* ...overige bestaande CSS hier... */
    </style>
</head>

<body>
    <div class="dashboard-logo">
        <img src="/assets/logo/logo.png" alt="BOLDYASE Studio Logo">
        <div class="studio">BOLDYASE Studio</div>
    </div>
    <div class="dashboard-container">

        <!-- NAV -->
        <nav class="dashboard-nav">
            <ul>
                <li><a href="#"><span class="icon">👗</span> Collecties</a></li>
                <li><a href="#"><span class="icon">🎨</span> Ontwerpen</a></li>
                <li><a href="#"><span class="icon">🧵</span> Monsters</a></li>
                <li><a href="#"><span class="icon">📦</span> Orders</a></li>
                <li><a href="#"><span class="icon">📊</span> Analyse</a></li>
                <li><a href="#"><span class="icon">❓</span> Hulp</a></li>
            </ul>
            <div class="nav-bottom">
                <div class="profile">Elton <span class="icon">👤</span></div>
                <button id="theme-toggle">🌞/🌚</button>
            </div>
        </nav>

        <!-- MAIN -->
        <main class="dashboard-main">
            <div class="analytics-bar">
                <div class="stat-tile">Productiedoorlooptijd<br><strong>18 dagen</strong></div>
                <div class="stat-tile">Kostenverwachting<br><strong>€12.4k</strong></div>
                <div class="stat-tile">Monsterfouten<br><strong>2%</strong></div>
                <div class="stat-tile"><span class="icon">📈</span><br>Efficiëntiecurve</div>
            </div>
            <section class="projects">
                <div class="project-card">
                    <div class="card-header">
                        <span class="title">Voorjaarscollectie 2024</span>
                        <span class="badge gold">In productie</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" style="width:45%"></div>
                    </div>
                    <div class="meta">
                        <span class="icon">🗓️</span> 12 juli
                        <span class="icon">⏰</span> 30 sept
                    </div>
                    <div class="widgets">
                        <div class="widget designer">
                            <h3>Ontwerpdetails</h3>
                            <div class="sketch-preview">[Digitaal schetsvoorbeeld]</div>
                            <div class="color-palette">
                                <span class="color" style="background:#A865C6"></span>
                                <span class="color" style="background:#CB5454"></span>
                            </div>
                            <button class="btn gold">Monsterfeedback toevoegen</button>
                        </div>
                        <div class="widget manufacturer">
                            <div class="steps">
                                <span class="step done">Snijden</span> →
                                <span class="step active">Naadwerk</span> →
                                <span class="step">Kwaliteitscontrole</span>
                            </div>
                            <div class="material-stock">Katoen jersey: <strong>85%</strong></div>
                        </div>
                    </div>
                </div>
                <!-- Je kunt hier meerdere project-cards toevoegen -->
            </section>
        </main>

        <!-- SIDEBAR -->
        <aside class="dashboard-sidebar">
            <div class="chat-panel">
                <div class="chat-header">Chat</div>
                <div class="chat-message">
                    <span class="avatar">👤</span>
                    <span class="msg">Heb feedback op T2-snede</span>
                    <span class="file-preview">[PDF]</span>
                </div>
                <input type="text" placeholder="Stuur ontwerpupdate...">
            </div>
            <div class="activity-timeline">
                <div class="event"><strong>Vandaag:</strong> Proefmodel goedgekeurd</div>
                <div class="event"><strong>2 dagen geleden:</strong> Materialen vertraagd</div>
            </div>
            <div class="notifications">
                <span class="icon bell">🔔<span class="badge red">3</span></span>
                <div class="dropdown">
                    <div>Melding 1</div>
                    <div>Melding 2</div>
                    <div>Melding 3</div>
                </div>
            </div>
        </aside>
    </div>

    <footer class="dashboard-footer">
        <div class="inspiration-bar">
            <div class="carousel">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=facearea&w=400&q=80" alt="NYFW-trends">
                <img src="https://images.unsplash.com/photo-1469398715555-76331e1586d7?auto=format&fit=facearea&w=400&q=80" alt="Duurzame stoffen">
                <!-- Voeg je eigen modefoto's toe of vervang deze URL's -->
            </div>
        </div>
    </footer>
</body>

</html>