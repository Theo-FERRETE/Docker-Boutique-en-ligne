<?php
require_once 'User.php';
header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
if ($action === 'register') {
    $data = json_decode(file_get_contents('php://input'), true);
    $res = User::register($data['username'], $data['email'], $data['password']);
    echo json_encode(['success' => $res]);
}
if ($action === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user = User::login($data['email'], $data['password']);
    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
