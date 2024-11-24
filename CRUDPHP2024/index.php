<?php 
/*
CONEXION A LA BASE DE DATOS
*/
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "usuarios";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexion fallida: ".$conn->connect_error);
    }
/*
FIN DE CODIGO DE LA CONEXION A LA BASE DE DATOS
*/

/*
INSERTAR UN USUARIO EN LA BD
*/

    if (isset($_POST['agregarUsuario'])) {
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $edad = $_POST['edad'];
        $distrito = $_POST['distrito'];
        $email = $_POST['email'];

        $query = "INSERT INTO usuario (nombres, apellidos, edad, distrito, email) 
        VALUES ('$nombres', '$apellidos', '$edad', '$distrito', '$email')";

        $conn->query($query);

        header("Location: index.php");
    }

    /*
ELIMINAR UN USUARIO EN LA BD
*/
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = "DELETE FROM usuario WHERE id = $id";
        $conn->query($query);

        header("Location: index.php");
    }

    /*
ACTUALIZAR UN USUARIO EN LA BD
*/    
if (isset($_POST['actualizarUsuario'])) {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $distrito = $_POST['distrito'];
    $email = $_POST['email'];
   

    $query = "UPDATE usuario SET nombres='$nombres', apellidos='$apellidos', 
    edad=$edad, distrito='$distrito', email='$email'
    WHERE id = $id";
    $conn->query($query);

    header("Location: index.php");
}

    


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP CON BOOTSTRAP 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="container mt-4">
        <h1 class="text-center">CRUD PHP CON BOOTSTRAP 5</h1>
    </div>
    
    <!-- MODAL PARA AGREGAR UN USUARIO -->
    <!-- Button trigger modal -->
    <div class="d-flex justify-content-start mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Agregar Usuario
            </button>
        </div>

 
<!-- TABLA QUE MUESTRA LOS USUARIOS DE LA BASE DE DATOS -->
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Edad</th>
            <th scope="col">Distrito</th>
            <th scope="col">Email</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = "SELECT * FROM usuario";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) { 
                    // echo"<br>";
                    // print_r($row);
                   // echo"<br>";
                    echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombres']}</td>
                            <td>{$row['apellidos']}</td>
                            <td>{$row['edad']}</td>
                            <td>{$row['distrito']}</td>
                            <td>{$row['email']}</td>                 
                            <td>
                            
                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal{$row['id']}'>Editar</button>
                            <a href='?delete={$row['id']}' class='btn btn-danger'>Eliminar</a>               
                        </tr>";
            ?>        
                    
                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nombres</label>
                                        <input type="text" class="form-control" name="nombres" value="<?php echo $row['nombres']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" name="apellidos" value="<?php echo $row['apellidos']; ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Edad</label>
                                        <input type="number" class="form-control" name="edad" value="<?php echo $row['edad']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Distrito</label>
                                        <input type="text" class="form-control" name="distrito" value="<?php echo $row['distrito']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <!-- boton guardar cambios debe ser de tipo submit y atributo name ira al codigo-->
                                    <button type="submit" name="actualizarUsuario" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    
   <!-- Modal INSERTAR USUARIO -->
   <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Agregar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nombres</label>
                                <input type="text" class="form-control" name="nombres" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Edad</label>
                                <input type="number" class="form-control" name="edad" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Distrito</label>
                                <input type="text" class="form-control" name="distrito" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <!-- boton guardar debe ser de tipo submit, atributo name ira al codigo -->
                            <button type="submit" name="agregarUsuario" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    

                
                
                
            <?php } ?>             
        
            
        </tbody>
    </table>   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
</html>