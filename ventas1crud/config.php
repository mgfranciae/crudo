<?php
$host = 'localhost';
$user = 'root';  // Usuario por defecto en XAMPP
$password = "";      // Contraseña por defecto en XAMPP
$dbname = 'ventas'; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
?>