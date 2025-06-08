<?php
include 'conexionbd.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST['nombre_categoria']);
    $ubicacion = trim($_POST['ubicacion_categoria']);
    $estado = $_POST['estado_categoria'];


    if (empty($nombre) || empty($ubicacion)) {
        echo "<script>alert('Todos los campos marcados con * son obligatorios.'); window.history.back();</script>";
        exit;
    }


    $sql = "INSERT INTO categoria (nombre, ubicacion, estado) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $nombre, $ubicacion, $estado);

        if ($stmt->execute()) {
            echo "<script>alert('Categoría registrada correctamente.'); window.location.href='listaCategorias.php';</script>";
        } else {
            echo "<script>alert('Error al registrar la categoría.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error en la preparación de la consulta.'); window.history.back();</script>";
    }

    $conn->close();
} else {
    
    header("Location: nuevaCategoria.php");
    exit();
}
?>
