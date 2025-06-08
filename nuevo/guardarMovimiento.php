<?php
include 'conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caja = $_POST['movimiento_caja'] ?? '';
    $tipo = $_POST['movimiento_tipo'] ?? '';
    $cantidad = $_POST['movimiento_cantidad'] ?? '0.00';
    $motivo = $_POST['movimiento_motivo'] ?? '';

    
    if (empty($caja) || empty($tipo) || empty($cantidad) || !is_numeric($cantidad)) {
        echo "Error: Datos inválidos o incompletos.";
        exit;
    }


    $cantidad = floatval($cantidad);

    $sql = "INSERT INTO movimiento_caja (caja, tipo_movimiento, cantidad, motivo)
            VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssds", $caja, $tipo, $cantidad, $motivo);

    if ($stmt->execute()) {
        echo "✅ Movimiento registrado exitosamente.";
        
    } else {
        echo "❌ Error al registrar el movimiento: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
?>
