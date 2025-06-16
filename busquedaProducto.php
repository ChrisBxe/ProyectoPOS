<?php
include 'conexionbd.php';

$codigo = $_POST['codigo'];

$sql = "SELECT * FROM producto WHERE codigo_barra = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($producto = $result->fetch_assoc()) {
    echo json_encode($producto);
} else {
    echo json_encode(["error" => "Producto no encontrado"]);
}
?>