<?php
// Incluir la conexión a la base de datos
include 'conexionbd.php';

$id_usuario = null;
$usuario = null;
$cajas = [];
$mensaje = '';

// 1. OBTENER EL ID DEL USUARIO
if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
} elseif (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
} else {
    die("Error: No se ha especificado un ID de usuario.");
}

// 2. PROCESAR EL FORMULARIO (CUANDO SE ENVÍA POR POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $cargo = $_POST['cargo'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];
    $id_caja = $_POST['caja_ventas'] ?? null;
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $estado_cuenta = $_POST['estado_cuenta'];
    $contrasena = $_POST['contrasena'];
    $repetir_contrasena = $_POST['repetir_contrasena'];

    // Validar si el nuevo email o nombre de usuario ya existen en OTRO usuario
    $sql_check = "SELECT id_usuario FROM usuarios WHERE (nombre_usuario = ? OR email = ?) AND id_usuario != ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("ssi", $nombre_usuario, $email, $id_usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $mensaje = "Error: El nombre de usuario o el email ya están en uso por otro usuario.";
    } else {
        // Inicializar la consulta de actualización y los parámetros
        $sql_update = "UPDATE usuarios SET tipo_documento=?, numero_documento=?, cargo=?, nombres=?, apellidos=?, telefono=?, genero=?, id_caja=?, nombre_usuario=?, email=?, estado=? ";
        $params = [$tipo_documento, $numero_documento, $cargo, $nombres, $apellidos, $telefono, $genero, $id_caja, $nombre_usuario, $email, $estado_cuenta];
        $types = "ssssssssssi";

        // Lógica para actualizar la contraseña SÓLO si se proporciona una nueva
        if (!empty($contrasena)) {
            if ($contrasena === $repetir_contrasena) {
                $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);
                $sql_update .= ", password=? ";
                $params[] = $contrasena_hasheada;
                $types .= "s";
            } else {
                $mensaje = "Error: Las nuevas contraseñas no coinciden.";
            }
        }

        if (empty($mensaje)) {
            $sql_update .= "WHERE id_usuario = ?";
            $params[] = $id_usuario;
            $types .= "i";
            
            $stmt_update = $conexion->prepare($sql_update);
            // Usar el operador "splat" (...) para pasar el array de parámetros a bind_param
            $stmt_update->bind_param($types, ...$params);

            if ($stmt_update->execute()) {
                echo "<script>alert('Usuario actualizado exitosamente.'); window.location.href='listaUsuarios.php';</script>";
                exit();
            } else {
                $mensaje = "Error al actualizar el usuario: " . $stmt_update->error;
            }
            $stmt_update->close();
        }
    }
    $stmt_check->close();
}

// 3. OBTENER DATOS ACTUALES PARA MOSTRAR EN EL FORMULARIO
$sql_fetch_user = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt_fetch_user = $conexion->prepare($sql_fetch_user);
$stmt_fetch_user->bind_param("i", $id_usuario);
$stmt_fetch_user->execute();
$resultado_user = $stmt_fetch_user->get_result();

if ($resultado_user->num_rows === 1) {
    $usuario = $resultado_user->fetch_assoc();
} else {
    die("Usuario no encontrado.");
}
$stmt_fetch_user->close();

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-TF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="" alt="Avatar" class="avatar">
                <h2>*usuario logeado</h2>
                <p>*rol logeado*</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="active"><a href="dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon">🛠️</span> Administracion</a>
                        <ul class="submenu">
                            <li><a href="nuevaCaja.php"><span class="icon"></span> Nueva caja</a></li>
                            <li><a href="nuevaCategoria.php"><span class="icon"></span> Nueva categoria</a></li>
                            <li><a href="nuevoUsuario.php"><span class="icon"></span> Nuevo usuario</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon">📦</span> Productos</a>
                        <ul class="submenu">
                            <li><a href="nuevoProducto.php"><span class="icon"></span> Nueva Producto</a></li>
                            <li><a href="PorductosAlmacen.php"><span class="icon"></span> Productos en Almacen</a></li>
                            <li><a href="productoMinStock.php"><span class="icon"></span> Productos en stok minimo</a></li>
                            <li><a href="buscarProducto.php"><span class="icon"></span> Buscar Producto</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon">🛍️</span> Ventas</a>
                        <ul class="submenu">
                            <li><a href="nuevaVenta.php"><span class="icon"></span> Nueva Venta</a></li>
                            <li><a href="ventasRealizadas.php"><span class="icon"></span> Ventas realizadas</a></li>
                            <li><a href="buscarXCodigo.php"><span class="icon"></span> Buscar venta por codigo</a></li>
                            <li><a href="buscarXFecha.php"><span class="icon"></span> Buscar venta por fecha</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon">🏦</span> Movimientos en caja</a>
                        <ul class="submenu">
                            <li><a href="nuevoMovimiento.php"><span class="icon"></span> Nuevo Movimineto</a></li>
                            <li><a href="movimientosRealizados.php"><span class="icon"></span> Movimientos realizados</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon">📄</span> Reportes</a>
                        <ul class="submenu">
                            <li><a href="reporteVenta.php"><span class="icon"></span> Reportes de Venta</a></li>
                            <li><a href="reporteInventario.php"><span class="icon"></span> Reportes de Inventario</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon">⚙️</span> Configuracion</a>
                        <ul class="submenu">
                            <li><a href="datos.php"><span class="icon"></span> Datos</a></li>
                        </ul>
                    </li>
            </nav>
        </aside>
        <main class="main-content">
            <header class="top-bar">
                <div class="menu-toggle">
                    <span class="icon"></span>
                </div>
                <div class="dashboard-title">
                    <h1>ADMINISTRACION</h1>
                </div>
                <div class="user-actions">
                    <span class="icon"></span>
                    <span class="icon"></span>
                    <span class="icon">POWER</span>
                </div>
            </header>
            <main class="main-content">
            <header class="top-bar">
                <div class="dashboard-title"><h1>ADMINISTRACIÓN</h1></div>
            </header>
            <section class="page-content">
                <h2><span class="icon section-icon"></span> ACTUALIZAR USUARIO</h2>
                <?php if ($mensaje): ?>
                    <p style="color: red; text-align: center;"><?php echo htmlspecialchars($mensaje); ?></p>
                <?php endif; ?>

                <form action="actualizarUsuario.php" method="POST">
                    <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>">

                    <div class="form-panel">
                        <h3>Información Personal</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo de documento</label>
                                <select id="tipo_documento" name="tipo_documento">
                                    <option value="dni" <?php echo ($usuario['tipo_documento'] == 'dni') ? 'selected' : ''; ?>>DNI</option>
                                    <option value="pasaporte" <?php echo ($usuario['tipo_documento'] == 'pasaporte') ? 'selected' : ''; ?>>Pasaporte</option>
                                    <option value="cedula" <?php echo ($usuario['tipo_documento'] == 'cedula') ? 'selected' : ''; ?>>Cédula</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numero_documento">Número de documento</label>
                                <input type="text" id="numero_documento" name="numero_documento" value="<?php echo htmlspecialchars($usuario['numero_documento']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                <select id="cargo" name="cargo">
                                    <option value="administrador" <?php echo ($usuario['cargo'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                                    <option value="cajero" <?php echo ($usuario['cargo'] == 'cajero') ? 'selected' : ''; ?>>Cajero</option>
                                    <option value="vendedor" <?php echo ($usuario['cargo'] == 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                             <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" id="nombres" name="nombres" value="<?php echo htmlspecialchars($usuario['nombres']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="form-group">
                                <label>Género</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="genero" value="masculino" <?php echo ($usuario['genero'] == 'masculino') ? 'checked' : ''; ?>> Masculino</label>
                                    <label><input type="radio" name="genero" value="femenino" <?php echo ($usuario['genero'] == 'femenino') ? 'checked' : ''; ?>> Femenino</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <h3>Información de la Cuenta</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre_usuario">Nombre de usuario</label>
                                <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contrasena">Nueva Contraseña</label>
                                <input type="password" id="contrasena" name="contrasena" placeholder="Dejar en blanco para no cambiar">
                            </div>
                            <div class="form-group">
                                <label for="repetir_contrasena">Repetir Contraseña</label>
                                <input type="password" id="repetir_contrasena" name="repetir_contrasena" placeholder="Dejar en blanco para no cambiar">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="estado_cuenta">Estado de la cuenta</label>
                                <select id="estado_cuenta" name="estado_cuenta">
                                    <option value="1" <?php echo ($usuario['estado'] == 1) ? 'selected' : ''; ?>>Activa</option>
                                    <option value="0" <?php echo ($usuario['estado'] == 0) ? 'selected' : ''; ?>>Inactiva</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions-main">
                        <button type="submit" class="btn btn-primary">ACTUALIZAR USUARIO</button>
                        <a href="listaUsuarios.php" class="btn btn-secondary">CANCELAR</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>