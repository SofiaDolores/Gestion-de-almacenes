<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header('Location: indez.php');
?>
