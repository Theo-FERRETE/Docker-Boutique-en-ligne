<?php
// Récupère l'ID du jeu depuis l'URL
$gameId = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Détail du jeu - Boutique Jeux Vidéo</title>
  <link rel="stylesheet" href="assets/css/global.css" />
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <div id="game-detail">
      <p style="color:#ff9100;text-align:center;">Chargement du jeu...</p>
    </div>
    <a href="jeux.php" class="see-all-btn" style="margin-top:2rem;">Retour au catalogue</a>
  </main>
  <script>
    const API_KEY = "ab55f219e1a842bea225f2d3c54eaa1c"; // Mets ta clé ici
    const gameId = <?= $gameId ?>;
    const detailDiv = document.getElementById('game-detail');

    if (!gameId) {
      detailDiv.innerHTML = "<p style='color:#ff2e63;text-align:center;'>Aucun jeu sélectionné.</p>";
    } else {
      fetch(`https://api.rawg.io/api/games/${gameId}?key=${API_KEY}`)
        .then(res => res.json())
        .then(game => {
          detailDiv.innerHTML = `
            <h2 style="color:#ff9100;">${game.name}</h2>
            <img src="${game.background_image || ''}" alt="${game.name}" style="width:100%;max-width:480px;border-radius:14px;box-shadow:0 2px 16px #ff910033;margin-bottom:1.1rem;">
            <div class="modal-meta" style="margin-bottom:1rem;color:#ff2e63;font-weight:600;font-size:1.05rem;">
              Note : ${game.rating}/5<br>
              Plateformes : ${game.parent_platforms ? game.parent_platforms.map(p => p.platform.name).join(', ') : ''}
            </div>
            <p style="color:#fff;">${game.description_raw ? game.description_raw : 'Pas de description.'}</p>
          `;
        })
        .catch(() => {
          detailDiv.innerHTML = "<p style='color:#ff2e63;text-align:center;'>Erreur lors du chargement du jeu.</p>";
        });
    }
  </script>
</body>
</html>
