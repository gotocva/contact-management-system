<?php
$host = 'localhost';
$db = 'contact_management';
$user = 'root'; // Change according to your setup
$pass = 'root'; // Change according to your setup

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
