<?php
session_start();
require_once 'api/User.php';

if (isset($_SESSION['user'])) {
    header('Location: profile.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $email && $password) {
        $user = User::register($username, $email, $password);
        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
            ];
            header('Location: profile.php');
            exit;
        } else {
            $message = "Cet email est déjà utilisé ou une erreur est survenue.";
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
  <title>Inscription - Boutique Jeux Vidéo</title>
  <link rel="stylesheet" href="assets/css/global.css" />
  <link rel="stylesheet" href="assets/css/auth.css" />
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <h2>Inscription</h2>
    <?php if ($message): ?>
      <p style="color: red; font-weight: bold; text-align:center;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post" action="register.php" class="auth-form">
      <input type="text" name="username" placeholder="Nom d'utilisateur" required minlength="3" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" />
      <input type="email" name="email" placeholder="Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
      <input type="password" name="password" placeholder="Mot de passe" required minlength="6" />
      <button type="submit">S'inscrire</button>
    </form>
    <p style="text-align:center; margin-top:1rem;">
      Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>
    </p>
  </main>
</body>
</html>
