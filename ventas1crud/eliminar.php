<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM productos WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente.";
        echo "<br><a href='index.php'>Volver a la lista</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
