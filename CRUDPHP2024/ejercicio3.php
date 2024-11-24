<?php

error_reporting(0);
$precio = $_POST["precio"];
$cantidad = $_POST["cantidad"];

$neto = $precio * $cantidad;

?>
<!--FRONTEND-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <form action="" method="post">

        <label for="">Precio del producto</label>
        <input type="number" name="precio" id="precio"require> <br><br>
        <label for="">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad"require> <br><br>

        <button type="submit">CALCULAR</button>
        <br>
        <br>
    </form>
    <?php
    echo "<h2>El precio del producto es S/ $precio</h2> <br>";
    echo "<h2>La cantidad es S/ $cantidad</h2> <br>";
    echo "<h1>El neto a pagar es S/ $neto</h1>";
    ?>
</body>

</html>
