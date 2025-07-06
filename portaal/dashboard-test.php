<?php
// Minimalistische Boldyase System Control Center V3

// Dummy data voor demo (vervang door echte checks)
$version = '8.1.1.2';
$memory = '256M';
$max_time = '30s';
$status_cards = [
    ['title' => 'Composer.json check', 'desc' => 'Controleert of composer.json aanwezig en valide is.', 'status' => 'OK'],
    ['title' => 'Database connectiviteit', 'desc' => 'Test databaseverbinding.', 'status' => 'Beschikbaar'],
    ['title' => '.env bestand', 'desc' => 'Controleert of .env aanwezig is.', 'status' => 'OK'],
    ['title' => 'Uploads map', 'desc' => 'Controleert schrijfbaarheid van uploads.', 'status' => 'OK'],
    ['title' => 'AI API bereikbaarheid', 'desc' => 'Test verbinding met AI-API.', 'status' => 'Test'],
    ['title' => 'Cache directory', 'desc' => 'Controleert of cache-map bestaat.', 'status' => 'Fix'],
    ['title' => 'Stuur testmail', 'desc' => 'Verstuur een testmail naar admin.', 'status' => 'Test'],
];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Boldyase System Control Center</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
<style>
:root {
  --bg: #0a0a0a;
  --sidebar: #121212;
  --card: #1a1a1a;
  --white: #fff;
  --gray: #d0d0d0;
  --blue: #5ee6ff;
  --primary: #6366F1;
  --shadow: 0 14px 38px 0 rgba(0,0,0,0.2);
  --radius: 24px;
  --footer: #090909;
  --success: #4ade80;
  --danger: #f87171;
  --warning: #fbbf24;
}
html,body {
  height: 100%;
  margin: 0;
  padding: 0;
  background: var(--bg);
  color: var(--gray);
  font-family: 'Montserrat', Arial, sans-serif;
  font-size: 17px;
  letter-spacing: 0.01em;
}
.app-shell {
  display: flex;
  min-height: 100vh;
}

/* Sidebar */
.sidebar {
  width: 320px;
  background: var(--sidebar);
  border-radius: var(--radius);
  margin: 24px 0 24px 24px;
  padding: 32px 24px 24px 24px;
  display: flex;
  flex-direction: column;
  box-shadow: var(--shadow);
  min-width: 270px;
  max-width: 340px;
  justify-content: space-between;
  height: calc(100vh - 48px);
}
.sidebar .title {
  font-size: 1.7em;
  font-weight: 700;
  color: var(--white);
  margin-bottom: 36px;
  letter-spacing: .04em;
}
.nav {
  flex: 1;
}
.nav-item {
  display: flex;
  align-items: center;
  gap: 18px;
  font-size: 1.1em;
  color: var(--gray);
  padding: 15px 12px;
  border-radius: 12px;
  margin-bottom: 8px;
  cursor: pointer;
  background: none;
  border: none;
  transition: background 0.18s;
}
.nav-item .fa {
  color: var(--blue);
  font-size: 1.25em;
  width: 28px;
  text-align: center;
}
.nav-item.active,
.nav-item:hover {
  background: rgba(255,255,255,0.04);
  color: var(--white);
}
.action-btn {
  width: 100%;
  margin: 32px 0 18px 0;
  padding: 14px 0;
  font-size: 1.09em;
  background: var(--primary);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  box-shadow: 0 2px 12px rgba(99,102,241,0.15);
  cursor: pointer;
  transition: background 0.2s;
  letter-spacing: .03em;
}
.action-btn:hover { background: #4f52c4; }
.info-card {
  background: var(--card);
  border-radius: 12px;
  padding: 16px 18px;
  font-size: 0.98em;
  margin-top: 30px;
  color: var(--gray);
  box-shadow: 0 2px 12px rgba(0,0,0,0.12);
  display: flex;
  flex-direction: column;
  gap: 4px;
  border: 1.5px solid #232323;
}
.info-card span {
  color: var(--blue);
  font-family: monospace;
  font-size: 1.01em;
}

/* Main Panel */
.main-panel {
  flex: 1;
  margin: 24px 24px 24px 0;
  display: flex;
  flex-direction: column;
  min-width: 0;
}
.panel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 36px;
}
.panel-header .panel-title {
  font-size: 2em;
  font-weight: 700;
  color: var(--white);
  letter-spacing: .01em;
}
.status-badge {
  background: var(--success);
  color: #111;
  font-weight: 700;
  border-radius: 8px;
  padding: 8px 22px;
  font-size: 1.08em;
  box-shadow: 0 2px 12px rgba(74,222,128,0.10);
}
.status-list {
  display: flex;
  flex-direction: column;
  gap: 22px;
  margin-bottom: 38px;
}
.status-card {
  background: var(--card);
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.13);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 26px 32px;
  border: 1.5px solid #232323;
  transition: box-shadow 0.18s, transform 0.18s;
  min-height: 70px;
  position: relative;
}
.status-card:hover {
  box-shadow: 0 6px 36px #00e5ff33, 0 2px 18px #000c  ;
  transform: translateY(-2px) scale(1.012);
}
.status-info {
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.status-title {
  font-weight: 600;
  color: var(--white);
  font-size: 1.1em;
}
.status-desc {
  font-size: 0.99em;
  color: var(--gray);
  opacity: 0.93;
}
.status-action {
  min-width: 110px;
  display: flex;
  justify-content: flex-end;
}
.status-btn {
  background: var(--primary);
  color: #fff;
  font-weight: 600;
  padding: 8px 26px;
  border: none;
  border-radius: 8px;
  font-size: 1em;
  transition: background 0.18s;
  cursor: pointer;
  box-shadow: 0 2px 10px #6366f130;
  position: relative;
  overflow: hidden;
}
.status-btn:hover { background: #4f52c4; }
.status-btn.loading:after {
  content: '';
  display: inline-block;
  width: 18px; height: 18px;
  border: 2.5px solid #fff;
  border-top: 2.5px solid #6366F1;
  border-radius: 50%;
  margin-left: 14px;
  animation: spin .8s linear infinite;
  vertical-align: middle;
}
@keyframes spin { 100% { transform: rotate(360deg); } }

.cta-btn {
  width: 100%;
  margin: 32px 0 0 0;
  padding: 18px 0;
  font-size: 1.18em;
  background: var(--blue);
  color: #111;
  border: none;
  border-radius: 13px;
  font-weight: 700;
  box-shadow: 0 2px 12px #5ee6ff22;
  letter-spacing: .03em;
  cursor: pointer;
  transition: background 0.18s;
}
.cta-btn:hover { background: #00e5ff; }

/* Footer */
.footer {
  width: 100vw;
  background: var(--footer);
  color: var(--gray);
  padding: 20px 0;
  position: fixed;
  left: 0; bottom: 0;
  z-index: 10;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 48px;
  box-shadow: 0 -2px 18px #0008;
  font-size: 1.08em;
  letter-spacing: .04em;
}
.footer .stat {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: 'Montserrat', monospace, sans-serif;
  color: var(--blue);
  font-size: 1.08em;
}

/* Responsive */
@media (max-width: 1000px) {
  .app-shell { flex-direction: column; }
  .sidebar { width: 100%; margin: 18px 18px 0 18px; height: auto; }
  .main-panel { margin: 18px; }
  .footer { font-size: 0.95em; gap: 18px; }
}
@media (max-width: 700px) {
  .sidebar, .main-panel { margin: 8px; border-radius: 14px;}
  .panel-header .panel-title { font-size: 1.13em;}
  .sidebar .title { font-size: 1.15em;}
}
</style>
</head>
<body>
<div class="app-shell">
  <aside class="sidebar">
    <div>
      <div class="title">Boldyase<br>System Control Center</div>
      <nav class="nav">
        <button class="nav-item active"><i class="fa fa-gauge"></i> Dashboard</button>
        <button class="nav-item"><i class="fa fa-database"></i> Database Test</button>
        <button class="nav-item"><i class="fa fa-house"></i> Homepage</button>
        <button class="nav-item"><i class="fa fa-github"></i> GitHub</button>
      </nav>
      <button class="action-btn"><i class="fa fa-paper-plane"></i> Stuur testmail</button>
    </div>
    <div class="info-card">
      <div>Versie: <span><?= $version ?></span></div>
      <div>Geheugen: <span><?= $memory ?></span></div>
      <div>Max tijd: <span><?= $max_time ?></span></div>
    </div>
  </aside>
  <main class="main-panel">
    <div class="panel-header">
      <div class="panel-title">Boldyase System Control Center</div>
      <div class="status-badge"><i class="fa fa-circle-check"></i> System OK — alles werkt zoals verwacht!</div>
    </div>
    <div class="status-list">
      <?php foreach($status_cards as $card): ?>
        <div class="status-card">
          <div class="status-info">
            <div class="status-title"><?= htmlspecialchars($card['title']) ?></div>
            <div class="status-desc"><?= htmlspecialchars($card['desc']) ?></div>
          </div>
          <div class="status-action">
            <button class="status-btn" onclick="btnLoad(this)">
              <?= htmlspecialchars($card['status']) ?>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="cta-btn"><i class="fa fa-rocket"></i> Open Dashboard</button>
  </main>
</div>
<div class="footer">
  <div class="stat"><i class="fa-brands fa-php"></i> PHP <?= PHP_VERSION ?></div>
  <div class="stat"><i class="fa fa-memory"></i> Memory <?= $memory ?></div>
  <div class="stat"><i class="fa fa-clock"></i> Max Exec <?= $max_time ?></div>
</div>
<script>
function btnLoad(btn) {
  btn.classList.add('loading');
  setTimeout(() => btn.classList.remove('loading'), 1100);
}
</script>
</body>
</html>