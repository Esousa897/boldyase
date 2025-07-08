const express = require('express');
const app = express();
const port = 3000;

// Settings
const AUTH_TOKEN = 'JouwSterkeApiToken123!'; // Zet zelf veilig in .env of config!

app.use(express.json());

// AUTH MIDDLEWARE
app.use((req, res, next) => {
  const token = req.headers['x-api-key'];
  if (!token || token !== AUTH_TOKEN) {
    return res.status(401).json({ error: 'Unauthorized' });
  }
  next();
});

// GET: Simpele suggestie
app.get('/api/suggestie', (req, res) => {
  res.json({ advies: 'BOLDYASE AI: Minimaliseer, optimaliseer, domineer.' });
});

// POST: Bijvoorbeeld voor AI-analyse van een tekst (dummy)
app.post('/api/analyseer', (req, res) => {
  const { tekst } = req.body;
  if (!tekst) return res.status(400).json({ error: 'Geen tekst ontvangen' });

  // Hier kan jouw AI-logica komen (dummy-response)
  res.json({
    original: tekst,
    resultaat: `AI-analyse van: ${tekst.length} tekens. Succes!`
  });
});

// 404-handler
app.use((req, res) => res.status(404).json({ error: 'Not found' }));

app.listen(port, () => {
  console.log(`Express API draait op http://localhost:${port}`);
});
