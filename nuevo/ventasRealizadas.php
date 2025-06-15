<?php
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
                    <h1>VENTAS</h1>
                </div>
                <div class="user-actions">
                    <span class="icon">POWER</span>
                </div>
            </header>

            <div class="page-content nueva-venta-layout">
                <div class="venta-main-column">
                    <nav class="page-tabs venta-tabs">
                        <ul>
                            <li><a href="nuevaVenta.php"><span class="icon"></span> NUEVA VENTA</a></li>
                            <li><a href="ventasRealizadas.php" class="tab-active"><span class="icon"></span> VENTAS REALIZADAS</a></li>
                            <li><a href="buscarXFecha.php"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                            <li><a href="buscarXCodigo.php"><span class="icon"></span> BUSCAR VENTA (CODIGO)</a></li>
                        </ul>
                    </nav>
                    <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FECHA</th>
                                <th>VENDEDOR</th>
                                <th>TOTAL</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta SQL con JOIN para obtener el nombre del vendedor
                            // Se asume que la tabla 'ventas' tiene un campo 'id_usuario' que es una clave foránea a la tabla 'usuarios'
                            $sql = "SELECT 
                                        v.id_venta, 
                                        v.fecha_venta, 
                                        v.total,  
                                        u.nombres, 
                                        u.apellidos 
                                    FROM ventas AS v
                                    JOIN usuarios AS u ON v.id_usuario = u.id_usuario
                                    ORDER BY v.fecha_venta DESC";

                            $resultado = $conexion->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                // Iterar sobre cada venta encontrada
                                while($venta = $resultado->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($venta['id_venta']); ?></td>
                                        <td><?php echo date("d/m/Y h:i A", strtotime($venta['fecha_venta'])); ?></td>
                                        <td><?php echo htmlspecialchars($venta['nombres'] . ' ' . $venta['apellidos']); ?></td>
                                        <td class="total-amount">$<?php echo number_format($venta['total_venta'], 2); ?></td>
                                        <td>
                                            <a href="eliminarVenta.php?id=<?php echo $venta['id_venta']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta? Esta acción no se puede deshacer.');">🗑️</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // Si no hay ventas, mostrar un mensaje
                                echo '<tr><td colspan="7">No hay ventas realizadas registradas.</td></tr>';
                            }
                            // Cerrar la conexión
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
            </div>
        </main>
    </div>
</body>
</html>