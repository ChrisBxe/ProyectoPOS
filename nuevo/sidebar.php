<?php


$usuario = $_SESSION['usuario'] ?? 'Invitado';
$rol = $_SESSION['rol'] ?? 'Sin rol';
?>

<aside class="sidebar">
    <div class="sidebar-header">
        <img src="" alt="Avatar" class="avatar">
        <h2><?php echo htmlspecialchars($usuario); ?></h2>
        <p><?php echo htmlspecialchars($rol); ?></p>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="active"><a href="dashboard.php"><span class="icon">📊</span> Dashboard</a></li>

            <li class="has-submenu">
                <a href="#"><span class="icon">🛠️</span> Administración</a>
                <ul class="submenu">
                    <li><a href="nuevaCategoria.php"><span class="icon"></span> Nueva categoría</a></li>
                    <li><a href="nuevoUsuario.php"><span class="icon"></span> Nuevo usuario</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><span class="icon">📦</span> Productos</a>
                <ul class="submenu">
                    <li><a href="nuevoProducto.php"><span class="icon"></span> Nuevo producto</a></li>
                    <li><a href="ProductosAlmacen.php"><span class="icon"></span> Productos en almacén</a></li>
                    <li><a href="productoMinStock.php"><span class="icon"></span> Productos en stock mínimo</a></li>
                    <li><a href="buscarProducto.php"><span class="icon"></span> Buscar producto</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><span class="icon">🛍️</span> Ventas</a>
                <ul class="submenu">
                    <li><a href="nuevaVenta.php"><span class="icon"></span> Nueva venta</a></li>
                    <li><a href="ventasRealizadas.php"><span class="icon"></span> Ventas realizadas</a></li>
                    <li><a href="buscarXCodigo.php"><span class="icon"></span> Buscar venta por código</a></li>
                    <li><a href="buscarXFecha.php"><span class="icon"></span> Buscar venta por fecha</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><span class="icon">📄</span> Reportes</a>
                <ul class="submenu">
                    <li><a href="reporteVenta.php"><span class="icon"></span> Reportes de venta</a></li>
                    <li><a href="reporteInventario.php"><span class="icon"></span> Reportes de inventario</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><span class="icon">⚙️</span> Configuración</a>
                <ul class="submenu">
                    <li><a href="datos.php"><span class="icon"></span> Datos</a></li>
                </ul>
            </li>

            <li>
                <a href="logout.php"><span class="icon">🚪</span> Cerrar sesión</a>
            </li>
        </ul>
    </nav>
</aside>
