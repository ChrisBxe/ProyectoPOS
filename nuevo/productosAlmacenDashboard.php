<?php
include("conexionbd.php");


$sql = "SELECT id, codigo_barras, nombre_producto, stock, precio FROM productos ORDER BY nombre_producto ASC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos en Almacén</title>
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
                            <li><a href="#"><span class="icon"></span> Nueva Producto</a></li>
                            <li><a href="#"><span class="icon"></span> Productos en Almacen</a></li>
                            <li><a href="#"><span class="icon"></span> Productos en stok minimo</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar Producto</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Ventas</a>
                        <ul class="submenu">
                            <li><a href="#"><span class="icon"></span> Nueva Venta</a></li>
                            <li><a href="#"><span class="icon"></span> Ventas realizadas</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar venta por codigo</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar venta por fecha</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Movimientos en caja</a>
                        <ul class="submenu">
                            <li><a href="#"><span class="icon"></span> Nueva Movimineto</a></li>
                            <li><a href="#"><span class="icon"></span> Movimientos realizados</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar Movimientos</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><span class="icon"></span> Reportes</a>
                        <ul class="submenu">
                            <li><a href="#"><span class="icon"></span> Reportes de Venta</a></li>
                            <li><a href="#"><span class="icon"></span> Reportes de Inventario</a></li>
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
            <div class="dashboard-title">
                <h1>PRODUCTOS EN ALMACÉN</h1>
            </div>
        </header>

        <section class="page-content">
            <div class="page-header">
                <h2>Listado de productos</h2>
                <p>Lista de todos los productos disponibles en el almacén.</p>
            </div>

            <table border="1" cellspacing="0" cellpadding="8">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código de Barras</th>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".htmlspecialchars($row['id'])."</td>";
                            echo "<td>".htmlspecialchars($row['codigo_barras'])."</td>";
                            echo "<td>".htmlspecialchars($row['nombre_producto'])."</td>";
                            echo "<td>".htmlspecialchars($row['stock'])."</td>";
                            echo "<td>$".number_format($row['precio'], 2)."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay productos en el almacén</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</div>
</body>
</html>

<?php
$conexion->close();
?>
