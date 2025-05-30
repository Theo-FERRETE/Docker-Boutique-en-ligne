<?php
require_once 'db.php';
class User {
    public static function register($username, $email, $password) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $stmt->execute([$username, $email, $hash]);
    }
    public static function login($email, $password) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
        return false;
    }
}
?>
