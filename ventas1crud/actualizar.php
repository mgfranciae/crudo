<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Producto actualizado exitosamente.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver a la lista</a>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id='$id'";
    $result = $conn->query($sql);
    $producto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6g2u7gGzt1T8Wb2OqeGp8pHCXbX6gq6vTxZ9F8fN2BxiNwpRwwjjHx1dYI" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h1>Editar producto</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-9aDoHZ8A7lSgI3uB3KnXHhFSP7smorFEVaxwbTjGfhAxXtF8H1KbBYsmuHt3HdzQ" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
?>
