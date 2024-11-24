<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES ('$nombre', '$descripcion', '$precio', '$stock')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Nuevo producto creado exitosamente.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver a la lista de productos</a>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    $conn->close();
} else {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6g2u7gGzt1T8Wb2OqeGp8pHCXbX6gq6vTxZ9F8fN2BxiNwpRwwjjHx1dYI" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h1>Crear nuevo producto</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-9aDoHZ8A7lSgI3uB3KnXHhFSP7smorFEVaxwbTjGfhAxXtF8H1KbBYsmuHt3HdzQ" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
?>
