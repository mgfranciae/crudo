<?php
include 'config.php';

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de productos</title>
    <!-- Enlace a Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Lista de productos</h1>
    <a href="crear.php" class="btn btn-primary mb-3">Añadir nuevo producto</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["nombre"]."</td>
                            <td>".$row["descripcion"]."</td>
                            <td>".$row["precio"]."</td>
                            <td>".$row["stock"]."</td>
                            <td>
                                <a href='actualizar.php?id=".$row["id"]."' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='eliminar.php?id=".$row["id"]."' class='btn btn-danger btn-sm'>Eliminar</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay productos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
