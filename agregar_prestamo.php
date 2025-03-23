<?php
include 'db.php';

// Obtener lista de usuarios y productos
$usuarios = $conn->query("SELECT * FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
$productos = $conn->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $producto_id = $_POST['producto_id'];
    $fecha_prestamo = $_POST['fecha_prestamo'];

    $stmt = $conn->prepare("INSERT INTO prestamos (usuario_id, producto_id, fecha_prestamo) VALUES (?, ?, ?)");
    $stmt->execute([$usuario_id, $producto_id, $fecha_prestamo]);

    header("Location: prestamos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Préstamo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <!-- Barra de navegaci��n -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="indez.php">Inventario</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="indez.php">Inicio <span class="sr-only">(actual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="agregar.php">Agregar Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="agregar_usuario.php">Agregar Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="devolver_prestamo.php">Gestionar Prestamos</a>
                </li>
            </ul>
        </div>
    </nav>
</head>
<body>
    <div class="container mt-5">
        <h1>Registrar Préstamo</h1>
        <form method="POST" action="agregar_prestamo.php">
            <div class="form-group">
                <label>Usuario:</label>
                <select name="usuario_id" class="form-control" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id'] ?>"><?= $usuario['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Producto:</label>
                <select name="producto_id" class="form-control" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['id'] ?>"><?= $producto['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Fecha de Préstamo:</label>
                <input type="date" name="fecha_prestamo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>