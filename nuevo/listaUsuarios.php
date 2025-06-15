<?php
// Incluimos el archivo de conexión a la base de datos
include 'conexionbd.php';
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
                <div class="dashboard-title">
                    <h1>ADMINISTRACION</h1>
                </div>
                <div class="user-actions">
                    <span class="icon">POWER</span>
                </div>
            </header>
            <section class="page-content">
                <nav class="page-tabs">
                    <ul>
                        <li><a href="nuevoUsuario.php"><span class="icon"></span> NUEVO USUARIO</a></li>
                        <li><a href="listaUsuarios.php" class="tab-active"><span class="icon"></span> LISTA DE USUARIOS</a></li>
                    </ul>
                </nav>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DOCUMENTO</th>
                                <th>CARGO</th>
                                <th>NOMBRE</th>
                                <th>USUARIO</th>
                                <th>TELEFONO</th>
                                <th>ACTUALIZAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Seleccionamos los campos necesarios de la tabla de usuarios. NUNCA selecciones la contraseña.
                            $sql = "SELECT id_usuario, tipo_documento, numero_documento, cargo, nombres, apellidos, nombre_usuario, telefono 
                                    FROM usuarios 
                                    ORDER BY nombres ASC";
                            $resultado = $conexion->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                // Iterar sobre cada fila de resultado
                                while($usuario = $resultado->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                                        <td><?php echo htmlspecialchars(strtoupper($usuario['tipo_documento']) . ' - ' . $usuario['numero_documento']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['cargo']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                                        <td>
                                            <a href="actualizarUsuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="action-icon action-edit" title="Actualizar"><span class="icon">✏️</span></a>
                                        </td>
                                        <td>
                                            <a href="eliminarUsuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?');"><span class="icon">🗑️</span></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // Si no hay usuarios, mostrar un mensaje en la tabla
                                echo '<tr><td colspan="7">No hay usuarios registrados.</td></tr>';
                            }
                            // Cerrar la conexión
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
            </section>
        </main>
    </div>
</body>
</html>