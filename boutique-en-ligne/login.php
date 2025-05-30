<?php
session_start();
require_once 'api/User.php';

if (isset($_SESSION['user'])) {
    header('Location: profile.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $user = User::login($email, $password);
        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
            ];
            header('Location: profile.php');
            exit;
        } else {
            $message = "Email ou mot de passe incorrect.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Connexion - Boutique Jeux Vidéo</title>
  <link rel="stylesheet" href="assets/css/global.css" />
  <link rel="stylesheet" href="assets/css/auth.css" />
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <h2>Connexion</h2>
    <?php if ($message): ?>
      <p style="color: red; font-weight: bold; text-align:center;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post" action="login.php" class="auth-form">
      <input type="email" name="email" placeholder="Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
      <input type="password" name="password" placeholder="Mot de passe" required />
      <button type="submit">Se connecter</button>
    </form>
    <p style="text-align:center; margin-top:1rem;">
      Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a>
    </p>
  </main>
</body>
</html>
