<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Catalogue - Boutique Jeux Vidéo</title>
  <link rel="stylesheet" href="assets/css/global.css" />
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <h2>Catalogue complet</h2>
    <div class="filters-bar">
      <select id="consoleFilter">
        <option value="">Toutes les consoles</option>
        <option value="1">PC</option>
        <option value="2">PlayStation</option>
        <option value="3">Xbox</option>
        <option value="4">iOS</option>
        <option value="5">Apple Macintosh</option>
        <option value="6">Linux</option>
        <option value="7">Nintendo</option>
      </select>
      <input type="text" id="search" placeholder="Rechercher un jeu..." />
    </div>
    <div id="games"></div>
    <!-- Modal détail jeu -->
    <div id="game-modal" class="modal" style="display:none;">
      <div class="modal-content">
        <span class="modal-close" id="modal-close">&times;</span>
        <div id="modal-body"></div>
      </div>
    </div>
  </main>
  <script src="assets/js/jeux.js"></script>
</body>
</html>
