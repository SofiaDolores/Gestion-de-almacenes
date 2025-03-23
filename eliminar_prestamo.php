<?php
include 'db.php';

// Verificamos si se ha enviado la solicitud de eliminación
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminamos el préstamo
    $sql = "DELETE FROM prestamos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    // Redirigimos de vuelta a la página de gestión de préstamos
    header('Location: prestamos.php');
    exit();
}
?>