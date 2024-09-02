<?php
$host = 'localhost'; // Cambia esto si tu base de datos no está en localhost
$dbname = 'aimys';
$username = 'root'; // Cambia esto si tienes un usuario diferente
$password = ''; // Cambia esto si tienes una contraseña

// Crear conexión
$conexion = new mysqli($host, $username, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
