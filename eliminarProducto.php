<?php
include 'conexionbd.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    
    $check = $conexion->query("SELECT * FROM productos WHERE id_producto = $id");
    if ($check->num_rows == 0) {
        header("Location: ProductosAlmacen.php?error=notfound");
        exit();
    }

    
    $sql = "DELETE FROM productos WHERE id_producto = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ProductosAlmacen.php?mensaje=eliminado");
    } else {
        
        header("Location: ProductosAlmacen.php?error=fk");
    }

    $conexion->close();
} else {
    header("Location: ProductosAlmacen.php?error=noid");
}
?>
