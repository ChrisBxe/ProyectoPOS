<?php
include('conexionbd.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_documento = $_POST['empresa_tipo_documento'];
    $numero_documento = $_POST['empresa_numero_documento'];
    $nombre = $_POST['empresa_nombre'];
    $direccion = $_POST['empresa_direccion'];
    $telefono = $_POST['empresa_telefono'];
    $email = $_POST['empresa_email'];
    $nombre_impuesto = $_POST['empresa_nombre_impuesto'];
    $impuesto_porcentaje = $_POST['empresa_impuesto_porcentaje'];
    $mostrar_impuestos = $_POST['mostrar_impuestos'] == 'si' ? 1 : 0;

    
    $verificar = $conexion->query("SELECT * FROM empresa");
    if ($verificar->num_rows > 0) {
    
        $sql = "UPDATE empresa SET 
                    tipo_documento = ?, 
                    numero_documento = ?, 
                    nombre = ?, 
                    direccion = ?, 
                    telefono = ?, 
                    email = ?, 
                    nombre_impuesto = ?, 
                    impuesto_porcentaje = ?, 
                    mostrar_impuestos = ?
                WHERE id_empresa = 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssssssd", $tipo_documento, $numero_documento, $nombre, $direccion, $telefono, $email, $nombre_impuesto, $impuesto_porcentaje, $mostrar_impuestos);
    } else {
    
        $sql = "INSERT INTO empresa (tipo_documento, numero_documento, nombre, direccion, telefono, email, nombre_impuesto, impuesto_porcentaje, mostrar_impuestos) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssssssd", $tipo_documento, $numero_documento, $nombre, $direccion, $telefono, $email, $nombre_impuesto, $impuesto_porcentaje, $mostrar_impuestos);
    }

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=1");
    } else {
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
