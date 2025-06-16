<?php
include("conexionbd.php"); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $cliente = trim($_POST['venta_cliente']);
    $tipo_pago = $_POST['tipo_pago'];
    $descuento = floatval($_POST['venta_descuento_porcentaje']);
    $total_pagado = floatval($_POST['venta_total_pagado']);
    $cambio = floatval($_POST['venta_cambio']);

    
    $fecha_venta = date('Y-m-d H:i:s');

    
    $caja_id = 1; 

    try {
        
        $conn->begin_transaction();

        
        $stmt = $conn->prepare("INSERT INTO venta (fecha, cliente, tipo_pago, descuento, total_pagado, cambio, id_caja) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdddi", $fecha_venta, $cliente, $tipo_pago, $descuento, $total_pagado, $cambio, $caja_id);
        $stmt->execute();

        $id_venta = $stmt->insert_id; 

       

        if (isset($_POST['productos'])) {
            $productos = json_decode($_POST['productos'], true); 

            $stmtDetalle = $conn->prepare("INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");

            foreach ($productos as $p) {
                $id_producto = intval($p['id_producto']);
                $cantidad = intval($p['cantidad']);
                $precio = floatval($p['precio_unitario']);
                $stmtDetalle->bind_param("iiid", $id_venta, $id_producto, $cantidad, $precio);
                $stmtDetalle->execute();

                
                $conn->query("UPDATE producto SET stock = stock - $cantidad WHERE id = $id_producto");
            }
        }

        $conn->commit();
        echo json_encode(['success' => true, 'mensaje' => 'Venta registrada exitosamente']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    $stmt->close();
    $conn->close();
}
?>
