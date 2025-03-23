<?php
include 'db.php';

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
$query->execute([$id]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("UPDATE usuario SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
    $stmt->execute([$nombre, $email, $telefono, $id]);

    header("Location: usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
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
        <h1>Editar Usuario</h1>
        <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?= $usuario['nombre'] ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?= $usuario['email'] ?>" required>
            </div>
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" name="telefono" class="form-control" value="<?= $usuario['telefono'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>