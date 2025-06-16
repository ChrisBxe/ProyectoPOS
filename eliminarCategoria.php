<?php
include 'conexionbd.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    
    $check = $conexion->query("SELECT COUNT(*) AS total FROM productos WHERE id_categoria = $id");
    $row = $check->fetch_assoc();

    if ($row['total'] > 0) {
        
        header("Location: listaCategorias.php?error=usada");
        exit();
    }

    
    $sql = "DELETE FROM categorias WHERE id_categoria = $id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: listaCategorias.php?mensaje=eliminado");
        exit();
    } else {
        echo "Error al eliminar categoría: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "ID no proporcionado.";
}
?>
