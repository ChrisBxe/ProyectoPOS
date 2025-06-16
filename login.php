<?php
session_start();
include 'conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario_data = $resultado->fetch_assoc();
        if (password_verify($contrasena, $usuario_data['contrasena'])) {
            $_SESSION['usuario'] = $usuario_data['nombre_usuario'];
            $_SESSION['rol'] = $usuario_data['cargo'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }

    $stmt->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="login_style.css">
    </head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-icon-main">
                <span class="icon-placeholder">👤</span>
            </div>
            <h2>Inicia sesion con tu cuenta</h2>
            <form action="#" method="POST">
                <div class="input-group">
                    <span class="input-icon-placeholder">👤</span>
                    <input type="text" name="usuario" placeholder="Usuario" required>
                </div>
                <div class="input-group">
                    <span class="input-icon-placeholder">🔒</span>
                    <input type="password" name="contrasena" placeholder="Contrasena" required>
                </div>
                <button type="submit" class="login-button">LOG IN</button>
            </form>
        </div>
    </div>
</body>
</html>