<?php
session_start();
include 'conexionbd.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha_venta'];
    $tipo_pago = $_POST['tipo_pago'];
    $producto_id = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $descuento_porcentaje = $_POST['descuento_venta'];
    $total_pagado = $_POST['total_pagado'];

    
    $stmt = $conexion->prepare("SELECT precio_venta, stock FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $stmt->bind_result($precio_unitario, $stock_actual);
    $stmt->fetch();
    $stmt->close();

    if ($cantidad > $stock_actual) {
        die("Error: No hay suficiente stock para realizar la venta.");
    }

    
    $subtotal = $precio_unitario * $cantidad;
    $iva = $subtotal * 0.15;
    $descuento = $subtotal * ($descuento_porcentaje / 100);
    $total = $subtotal + $iva - $descuento;
    $cambio = $total_pagado - $total;

    
    $conexion->begin_transaction();

    try {
        
        $stmt = $conexion->prepare("INSERT INTO ventas (fecha_venta, tipo_pago, subtotal, iva, descuento_porcentaje, total, total_pagado, cambio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdddddd", $fecha, $tipo_pago, $subtotal, $iva, $descuento, $total, $total_pagado, $cambio);
        $stmt->execute();
        $venta_id = $stmt->insert_id;
        $stmt->close();

        
        $stmt = $conexion->prepare("INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $venta_id, $producto_id, $cantidad, $precio_unitario);
        $stmt->execute();
        $stmt->close();

        
        $nuevo_stock = $stock_actual - $cantidad;
        $stmt = $conexion->prepare("UPDATE productos SET stock = ? WHERE id_producto = ?");
        $stmt->bind_param("ii", $nuevo_stock, $producto_id);
        $stmt->execute();
        $stmt->close();

        $conexion->commit();
        echo "Venta registrada correctamente. <a href='nuevaVenta.php'>Volver</a>";
    } catch (Exception $e) {
        $conexion->rollback();
        echo "Error al registrar venta: " . $e->getMessage();
    }
}
?>
