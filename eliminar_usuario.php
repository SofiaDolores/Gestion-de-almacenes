<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
$stmt->execute([$id]);

header("Location: usuarios.php");
exit;
?>