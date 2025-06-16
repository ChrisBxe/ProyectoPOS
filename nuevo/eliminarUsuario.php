<?php
include 'conexionbd.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    
    $check = $conexion->query("SELECT * FROM usuarios WHERE id_usuario = $id");
    if ($check->num_rows == 0) {
        
        header("Location: listaUsuarios.php?error=notfound");
        exit();
    }

    // Ejecutar eliminación
    $sql = "DELETE FROM usuarios WHERE id_usuario = $id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: listaUsuarios.php?mensaje=eliminado");
        exit();
    } else {
        header("Location: listaUsuarios.php?error=db");
        exit();
    }

    $conexion->close();
} else {
    header("Location: listaUsuarios.php?error=noid");
    exit();
}
?>
