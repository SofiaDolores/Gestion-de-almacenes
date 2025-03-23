<?php
include 'db.php';

// Consultar todos los préstamos
$query = $conn->query("SELECT p.*, u.nombre AS usuario, pr.nombre AS producto 
                       FROM prestamos p 
                       JOIN usuario u ON p.usuario_id = u.id 
                       JOIN productos pr ON p.producto_id = pr.id");
$prestamos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Préstamos</title>
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
        <h1 class="text-center">Lista de Préstamos</h1>
        <a href="agregar_prestamo.php" class="btn btn-primary mb-3">Registrar Préstamo</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Producto</th>
                    <th>Fecha de Préstamo</th>
                    <th>Fecha de Devolución</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prestamos as $prestamo): ?>
                    <tr>
                        <td><?= $prestamo['id']; ?></td>
                        <td><?= $prestamo['usuario']; ?></td>
                        <td><?= $prestamo['producto']; ?></td>
                        <td><?= $prestamo['fecha_prestamo']; ?></td>
                        <td><?= $prestamo['fecha_devolucion'] ? $prestamo['fecha_devolucion'] : 'No devuelto'; ?></td>
                        <td><?= $prestamo['estado']; ?></td>
                        <td>
                            <a href="editar_prestamo.php?id=<?= $prestamo['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar_prestamo.php?id=<?= $prestamo['id']; ?>" class="btn btn-danger">Eliminar</a>
                            <?php if ($prestamo['estado'] == 'prestado'): ?>
                                <a href="devolver_prestamo.php?id=<?= $prestamo['id']; ?>" class="btn btn-success">Marcar como Devuelto</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>