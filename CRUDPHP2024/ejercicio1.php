<?php

/*Un trabajador percibe inicialmente un haber básico, asimismo tiene una bonificación
del 20% del haber básico, también cuenta por gratificación anual el 50% del haber básico,
por movilidad el 15% del haber básico. Siendo el total de su remuneración:
haber _basico + bonificación + gratificación + novilidad. Pero tambien, tiene descuento por
AFP del 13% del total de su remuneracion y por adelanto del haber básico el 35% del total de su remuneracion.
*/
error_reporting(0);
$basico = $_POST["basico"];
$bono = $basico * 0.20;
$grati = $basico * 0.50;
$movilidad = $basico * 0.15;

$totalremuneración = $basico + $bono + $grati + $movilidad;


$afp = $totalremuneración * 0.13;
$adelanto = $totalremuneración * 0.35;
$neto = $totalremuneración - ($afp + $adelanto);

?>
<!--FRONTEND-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <form action="" method="post">

        <label for="">Haber básico</label>
        <input type="number" name="basico" id=""> <br><br>
        <button type="submit">CALCULAR</button>
        <br>
        <br>

    </form>
    <?php
    echo "<h2>El total de su remuneracion es S/ $totalremuneración</h2> <br> <br>";
    echo "<h1>El neto a pagar es S/ $neto</h1>";
    ?>
</body>

</html>