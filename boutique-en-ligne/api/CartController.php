<?php
session_start();
header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
if ($action === 'add') {
    $data = json_decode(file_get_contents('php://input'), true);
    $_SESSION['cart'][] = $data; // $data = [id, name, price]
    echo json_encode(['success' => true]);
}
if ($action === 'get') {
    echo json_encode($_SESSION['cart'] ?? []);
}
if ($action === 'remove') {
    $id = $_GET['id'] ?? null;
    if ($id !== null && isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($g) => $g['id'] != $id);
    }
    echo json_encode(['success' => true]);
}
if ($action === 'clear') {
    $_SESSION['cart'] = [];
    echo json_encode(['success' => true]);
}
?>
