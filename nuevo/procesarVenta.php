<?php
session_start();
include 'conexionbd.php';

$cliente = $_POST['cliente'];
$tipo_pago = $_POST['tipo_pago'];
$descuento = $_POST['descuento'];
$total_pagado = $_POST['total_pagado'];
$usuario_id = $_SESSION['usuario_id']; 

$subtotal = 0;
foreach ($_SESSION['venta'] as $item) {
    $subtotal += $item['subtotal'];
}

$iva = $subtotal * 0.15;
$descuento_valor = $subtotal * ($descuento / 100);
$total = ($subtotal + $iva) - $descuento_valor;
$cambio = $total_pagado - $total;

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO venta (fecha, cliente, total, tipo_pago, descuento, total_pagado, cambio, id_usuario) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsdddd", $cliente, $total, $tipo_pago, $descuento, $total_pagado, $cambio, $usuario_id);
    $stmt->execute();
    $id_venta = $stmt->insert_id;

    $stmtDetalle = $conn->prepare("INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio, subtotal) VALUES (?, ?, ?, ?, ?)");

    foreach ($_SESSION['venta'] as $item) {
        $stmtDetalle->bind_param("iiidd", $id_venta, $item['id_producto'], $item['cantidad'], $item['precio'], $item['subtotal']);
        $stmtDetalle->execute();
    }

    $conn->commit();
    unset($_SESSION['venta']);
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["error" => "Error al procesar venta"]);
}
?>
