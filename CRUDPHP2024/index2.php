<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'nuevo';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['agregarUsuario'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $distrito = $_POST['distrito'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];

    $query = "INSERT INTO usuario1 (nombres, apellidos, edad, distrito, email, dni) 
    VALUES ('$nombres', '$apellidos', $edad, '$distrito', '$email', '$dni')";
    $conn->query($query);

    header("Location: index2.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM usuario1 WHERE id = $id";
    $conn->query($query);

    header("Location: index2.php");
}

if (isset($_POST['actualizarUsuario'])) {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $distrito = $_POST['distrito'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];

    $query = "UPDATE usuario1 SET nombres='$nombres', apellidos='$apellidos', 
    edad=$edad, distrito='$distrito', email='$email', dni='$dni' 
    WHERE id = $id";
    $conn->query($query);

    header("Location: index2.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>

</head>

<body>

<style>
   
    table {
        width: 60%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    form{
        display: flex;
        flex-direction: column;
        align-items: left;

    }
    .boton{
        margin-top: 10px;
        padding: 10px;
        background-color: #4CAA50;
        color: white;
        border: none;
        cursor: pointer;
        width: 20%;
        align-self: left;
    }
    .boton1{
        margin-top: 10px;
        padding: 10px;
        background-color: #1098a8;
        color: white;
        border: none;
        cursor: pointer;
        width: 20%;
        align-self: left;
    }
</style>
    <h2>Sistema CRUD de Usuarios - CRUDO</h2>

    <h3>Agregar Usuario</h3>
    <form method="POST" action="">
        <label>Nombres: <input type="text" name="nombres" required></label><br>
        <label>Apellidos <input type="text" name="apellidos" required></label><br>
        <label>Edad: <input type="number" name="edad" required></label><br>
        <label>Distrito: <input type="text" name="distrito" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>DNI: <input type="text" name="dni" required></label><br>
        <button type="button" class="boton" name="agregarUsuario">Guardar</button>
   
    </form>

    <h3>Lista de Usuarios</h3>
    <table border="4">
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Edad</th>
            <th>Distrito</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Acciones</th>
        </tr>
        <?php
        $query = "SELECT * FROM usuario1";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombres']}</td>
                <td>{$row['apellidos']}</td>
                <td>{$row['edad']}</td>
                <td>{$row['distrito']}</td>
                <td>{$row['email']}</td>
                <td>{$row['dni']}</td>
                <td>
                    <a href='?edit={$row['id']}'>Editar</a>  
                    <a href='?delete={$row['id']}'>Eliminar</a>
                </td>
            </tr>";
        }

        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $query = "SELECT * FROM usuario1 WHERE id = $id";
            $result = $conn->query($query);
            $user = $result->fetch_assoc();
        ?>

            <tr>

                <form method="POST" action="">

                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <td colspan="8">
                      
                        <label>Nombres: <input type="text" name="nombres" value="<?php echo $user['nombres']; ?>" required></label>
                        <label>Apellidos: <input type="text" name="apellidos" value="<?php echo $user['apellidos']; ?>" required></label>
                        <label>Edad: <input type="number" name="edad" value="<?php echo $user['edad']; ?>" required></label><br>
                       
                        <label>Distrito: <input type="text" name="distrito" value="<?php echo $user['distrito']; ?>" required></label>
                        <label>Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required></label>
                        <label>DNI: <input type="text" name="dni" value="<?php echo $user['dni']; ?>" required></label><br>
                        <button class="boton1" type="submit" name="actualizarUsuario">Guardar Cambios</button><br>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
