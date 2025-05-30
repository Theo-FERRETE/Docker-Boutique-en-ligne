<?php
$host = 'db'; 
$user = 'user'; 
$password = 'userpass';
$database = 'boutique';

// Connexion à MySQL
$conn = new mysqli($host, $user, $password, $database);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
