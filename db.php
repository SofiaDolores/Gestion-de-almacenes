<?php
$host = 'localhost';
$dbname = 'unidsyst_gestion_almacenes';
$username = 'unidsyst_ga';
$password = 'gestionalmacenes';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>