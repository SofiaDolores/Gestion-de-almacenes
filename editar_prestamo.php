<?php
include 'db.php';

// Verificamos si se ha enviado el formulario
if (isset($_POST['editar_prestamo'])) {
    $id = $_POST['id'];
    $usuario_id = $_POST['usuario_id'];
    $producto_id = $_POST['producto_id'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];
    $estado = $_POST['estado'];

    // Actualizamos los datos del préstamo
    $sql = "UPDATE prestamos SET usuario_id = ?, producto_id = ?, fecha_prestamo = ?, fecha_devolucion = ?, estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usuario_id, $producto_id, $fecha_prestamo, $fecha_devolucion, $estado, $id]);

    header('Location: gestionar_prestamos.php');
    exit();
}

// Obtenemos los detalles del préstamo actual para mostrar en el formulario
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM prestamos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtenemos la lista de usuarios y productos para los select
    $usuarios = $conn->query("SELECT * FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
    $productos = $conn->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Préstamo</title>
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
        <h1>Editar Préstamo</h1>
        <form action="editar_prestamo.php" method="POST">
            <input type="hidden" name="id" value="<?= $prestamo['id'] ?>">

            <div class="form-group">
                <label for="usuario_id">Usuario</label>
                <select name="usuario_id" class="form-control" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id']; ?>" <?= $prestamo['usuario_id'] == $usuario['id'] ? 'selected' : '' ?>>
                            <?= $usuario['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="producto_id">Producto</label>
                <select name="producto_id" class="form-control" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['id']; ?>" <?= $prestamo['producto_id'] == $producto['id'] ? 'selected' : '' ?>>
                            <?= $producto['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_prestamo">Fecha de Préstamo</label>
                <input type="date" name="fecha_prestamo" class="form-control" value="<?= $prestamo['fecha_prestamo']; ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_devolucion">Fecha de Devolución</label>
                <input type="date" name="fecha_devolucion" class="form-control" value="<?= $prestamo['fecha_devolucion']; ?>">
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control">
                    <option value="prestado" <?= $prestamo['estado'] == 'prestado' ? 'selected' : '' ?>>Prestado</option>
                    <option value="devuelto" <?= $prestamo['estado'] == 'devuelto' ? 'selected' : '' ?>>Devuelto</option>
                </select>
            </div>

            <button type="submit" name="editar_prestamo" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>