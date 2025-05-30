<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Profil - Boutique Jeux Vidéo</title>
  <link rel="stylesheet" href="assets/css/global.css" />
  <link rel="stylesheet" href="assets/css/profile.css" />
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <h2>Mon Profil</h2>
    <div class="profile-block">
      <p><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($user['username']) ?></p>
      <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
      <!-- Ajoute d'autres infos si besoin -->
    </div>
  </main>
</body>
</html>
