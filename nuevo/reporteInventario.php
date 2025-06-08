<?php
include 'conexionbd.php';

$ordenar = $_GET['ordenar_reporte'] ?? 'nombre_asc';

switch ($ordenar) {
    case 'nombre_asc':
        $orderBy = "nombre_producto ASC";
        break;
    case 'nombre_desc':
        $orderBy = "nombre_producto DESC";
        break;
    case 'stock_asc':
        $orderBy = "stock_producto ASC";
        break;
    case 'stock_desc':
        $orderBy = "stock_producto DESC";
        break;
    default:
        $orderBy = "nombre_producto ASC";
}

$sql = "SELECT id_producto, nombre_producto, descripcion, stock_producto, precio FROM productos ORDER BY $orderBy";
$result = $conexion->query($sql);
if ($result === false) {
    die("Error en la consulta: " . $conexion->error);
}
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
                    <li class="active"><a href="dashboard.php"><span class="icon"></span> Dashboard</a></li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Administracion</a>
                        <ul class="submenu">
                            <li><a href="nuevaCaja.php"><span class="icon"></span> Nueva caja</a></li>
                            <li><a href="nuevaCategoria.php"><span class="icon"></span> Nueva categoria</a></li>
                            <li><a href="nuevoUsuario.php"><span class="icon"></span> Nuevo usuario</a></li>
                            <li><a href="nuevoCliente.php"><span class="icon"></span> Nuevo cliente</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Productos</a>
                        <ul class="submenu">
                            <li><a href="nuevoProducto.php"><span class="icon"></span> Nueva Producto</a></li>
                            <li><a href="#"><span class="icon"></span> Productos en Almacen</a></li>
                            <li><a href="#"><span class="icon"></span> Productos en stok minimo</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar Producto</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Ventas</a>
                        <ul class="submenu">
                            <li><a href="nuevaVenta.php"><span class="icon"></span> Nueva Venta</a></li>
                            <li><a href="#"><span class="icon"></span> Ventas realizadas</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar venta por codigo</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar venta por fecha</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Movimientos en caja</a>
                        <ul class="submenu">
                            <li><a href="nuevoMovimiento.php"><span class="icon"></span> Nueva Movimineto</a></li>
                            <li><a href="movimientosRealizados.php"><span class="icon"></span> Movimientos realizados</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Reportes</a>
                        <ul class="submenu">
                            <li><a href="#"><span class="icon"></span> Reportes de Venta</a></li>
                            <li><a href="reporteInventario.php"><span class="icon"></span> Reportes de Inventario</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Configuracion</a>
                        <ul class="submenu">
                            <li><a href="#"><span class="icon"></span> Datos</a></li>
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
                    <h1>REPORTES</h1> </div>
                <div class="user-actions">
                    <span class="icon"></span>
                    <span class="icon"></span>
                    <span class="icon">POWER</span>
                </div>
            </header>

            <section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon"></span> REPORTES DE INVENTARIO</h2> <p>En el modulo REPORTES podra ver, generar e imprimir reportes de inventario en formato PDF.</p>
                </div>

                <div class="report-generator-panel">
                    <h3>Generar reporte de inventario personalizado</h3>
                    <div class="form-group report-filter-group">
                        <form method="GET" action="reporteInventario.php">
                            <label for="ordenar_reporte">Ordenar por</label>
                            <select id="ordenar_reporte" name="ordenar_reporte">
                                <option value="nombre_asc" <?php if (($ordenar ?? '') == 'nombre_asc') echo 'selected'; ?>>Nombre (ascendente)</option>
                                <option value="nombre_desc" <?php if (($ordenar ?? '') == 'nombre_desc') echo 'selected'; ?>>Nombre (descendente)</option>
                                <option value="stock_asc" <?php if (($ordenar ?? '') == 'stock_asc') echo 'selected'; ?>>Stock (ascendente)</option>
                                <option value="stock_desc" <?php if (($ordenar ?? '') == 'stock_desc') echo 'selected'; ?>>Stock (descendente)</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-generate-report">
                                GENERAR REPORTE
                        </button>
                    </div>
                </div>
            </section>
            <table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Producto</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id_producto']); ?></td>
            <td><?php echo htmlspecialchars($row['nombre_producto']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($row['stock_producto']); ?></td>
            <td><?php echo htmlspecialchars(number_format($row['precio'], 2)); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

            </main>
    </div>
</body>
</html>