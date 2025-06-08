<?php
$host = "localhost";
$puerto = "3307"; 
$usuario = "root";
$contrasena = "usbw"; 
$base_datos = "ropa";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos, $puerto);

if ($conexion->connect_error) {
    die("Error de conexion: " . $conexion->connect_error);
} else {
    echo "Conexion exitosa a la base de datos.";
}
?>
