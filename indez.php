<?php
include 'db.php';

// Definimos un límite para considerar stock bajo
$limite_stock_bajo = 10;

// Consultamos todos los productos
$query = $conn->query("SELECT * FROM productos");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
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
        <h1 class="text-center">Lista de Productos</h1>
        <a href="usuarios.php" class="btn btn-info mb-3">Gestionar Usuarios</a>
        <a href="prestamos.php" class="btn btn-info mb-3">Gestionar Prestamos</a>
        <a href="agregar.php" class="btn btn-primary mb-3">Agregar Producto</a>
        <a href="generar_pdf.php" class="btn btn-secondary mb-3">Generar PDF</a> <!-- Botón para generar PDF -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Estado de Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr class="<?= $producto['cantidad'] <= $limite_stock_bajo ? 'table-danger' : '' ?>">
                        <td><?= $producto['id']; ?></td>
                        <td><?= $producto['nombre']; ?></td>
                        <td><?= $producto['descripcion']; ?></td>
                        <td><?= $producto['precio']; ?></td>
                        <td><?= $producto['cantidad']; ?></td>
                        <td>
                            <?php if ($producto['cantidad'] <= $limite_stock_bajo): ?>
                                <span class="badge badge-danger">Stock Bajo</span>
                            <?php else: ?>
                                <span class="badge badge-success">En Stock</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="editar.php?id=<?= $producto['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar.php?id=<?= $producto['id']; ?>" class="btn btn-danger">Eliminar</a>
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

