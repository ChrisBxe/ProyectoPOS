<?php
session_start();
$codigo = $_POST['codigo'];
$cantidad = $_POST['cantidad'];

include 'conexionbd.php';

$sql = "SELECT * FROM producto WHERE codigo_barra = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if ($producto) {
    $subtotal = $producto['precio'] * $cantidad;
    $_SESSION['venta'][] = [
        'id_producto' => $producto['id'],
        'codigo' => $producto['codigo_barra'],
        'nombre' => $producto['nombre'],
        'cantidad' => $cantidad,
        'precio' => $producto['precio'],
        'subtotal' => $subtotal
    ];
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Producto no encontrado"]);
}
?>
