<?php

include 'conexionbd.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $tipo_documento = $_POST['tipo_documento'] ?? '';
    $numero_documento = $_POST['numero_documento'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $usar_lector = $_POST['usar_lector'] ?? '';
    $tipo_codigo = $_POST['tipo_codigo'] ?? '';
    $caja_ventas = $_POST['caja_ventas'] ?? '';
    $nombre_usuario = $_POST['nombre_usuario'] ?? '';
    $email = $_POST['email'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $repetir_contrasena = $_POST['repetir_contrasena'] ?? '';
    $estado_cuenta = $_POST['estado_cuenta'] ?? '';

    
    $errores = [];

    if (!$tipo_documento) $errores[] = "Seleccione tipo de documento.";
    if (!$numero_documento) $errores[] = "Ingrese número de documento.";
    if (!$cargo) $errores[] = "Seleccione cargo.";
    if (!$nombres) $errores[] = "Ingrese nombres.";
    if (!$apellidos) $errores[] = "Ingrese apellidos.";
    if (!$nombre_usuario) $errores[] = "Ingrese nombre de usuario.";
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Ingrese un email válido.";
    if (!$contrasena) $errores[] = "Ingrese contraseña.";
    if ($contrasena !== $repetir_contrasena) $errores[] = "Las contraseñas no coinciden.";

    if (count($errores) > 0) {
        
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='nuevoUsuario.php'>Volver al formulario</a>";
        exit;
    }

    
    $hash_password = password_hash($contrasena, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO usuarios (tipo_documento, numero_documento, cargo, nombres, apellidos, telefono, genero, usar_lector, tipo_codigo, caja_ventas, nombre_usuario, email, contrasena, estado_cuenta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssssssssssi", $tipo_documento, $numero_documento, $cargo, $nombres, $apellidos, $telefono, $genero, $usar_lector, $tipo_codigo, $caja_ventas, $nombre_usuario, $email, $hash_password, $estado_cuenta);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Usuario registrado correctamente.</p>";
        echo "<a href='nuevoUsuario.php'>Registrar otro usuario</a>";
    } else {
        echo "<p style='color:red;'>Error al registrar usuario: " . $conexion->error . "</p>";
        echo "<a href='nuevoUsuario.php'>Volver al formulario</a>";
    }

    $stmt->close();
    $conexion->close();
} else {
    
    header("Location: nuevoUsuario.php");
    exit;
}
