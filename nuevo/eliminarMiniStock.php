<?php
include 'conexionbd.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

   
    $verificar = $conexion->query("SELECT * FROM productos WHERE id_producto = $id");
    if ($verificar->num_rows === 0) {
        header("Location: productoMinStock.php?error=noexiste");
        exit;
    }

    
    $sql = "DELETE FROM productos WHERE id_producto = $id";
    if ($conexion->query($sql)) {
        header("Location: productoMinStock.php?mensaje=eliminado");
    } else {
        header("Location: productoMinStock.php?error=noeliminado");
    }

    $conexion->close();
} else {
    header("Location: productoMinStock.php?error=invalido");
}
?>
