<?php
?>
<header>
  <h1>Boutique Jeux Vidéo</h1>
  <nav>
    <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Accueil</a>
    <a href="jeux.php" class="<?= basename($_SERVER['PHP_SELF']) == 'jeux.php' ? 'active' : '' ?>">Catalogue</a>
    <a href="panier.php" class="<?= basename($_SERVER['PHP_SELF']) == 'panier.php' ? 'active' : '' ?>">Panier</a>
    <?php if (isset($_SESSION['user'])): ?>
      <a href="profile.php" class="<?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">Profil</a>
      <a href="logout.php">Déconnexion</a>
    <?php else: ?>
      <a href="login.php" class="<?= basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '' ?>">Connexion</a>
      <a href="register.php" class="<?= basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : '' ?>">Inscription</a>
    <?php endif; ?>
  </nav>
</header>
