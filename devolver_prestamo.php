<?php
include 'db.php';

$id = $_GET['id'];
$fecha_devolucion = date('Y-m-d');

$stmt = $conn->prepare("UPDATE prestamos SET estado = 'devuelto', fecha_devolucion = ? WHERE id = ?");
$stmt->execute([$fecha_devolucion, $id]);

header("Location: prestamos.php");
exit
?>