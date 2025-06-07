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
                        <a><span class="icon"></span> Administracion</a>
                        <ul class="submenu">
                            <li><a href="nuevaCaja.php"><span class="icon"></span> Nueva caja</a></li>
                            <li><a href="nuevaCategoria.php"><span class="icon"></span> Nueva categoria</a></li>
                            <li><a href="nuevoUsuario.php"><span class="icon"></span> Nuevo usuario</a></li>
                            <li><a href="nuevoCliente.php"><span class="icon"></span> Nuevo cliente</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a><span class="icon"></span> Productos</a>
                        <ul class="submenu">
                            <li><a href="nuevoProducto.php"><span class="icon"></span> Nueva Producto</a></li>
                            <li><a href="PorductosAlmacen.php"><span class="icon"></span> Productos en Almacen</a></li>
                            <li><a href="productoMinStock.php"><span class="icon"></span> Productos en stok minimo</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a><span class="icon"></span> Ventas</a>
                        <ul class="submenu">
                            <li><a href="nuevaVenta.php"><span class="icon"></span> Nueva Venta</a></li>
                            <li><a href="ventasRealizadas.php"><span class="icon"></span> Ventas realizadas</a></li>
                            <li><a href="ventasPendientes.php"><span class="icon"></span> Ventas pendientes</a></li>
                            <li><a href="buscarXCodigo.php"><span class="icon"></span> Buscar venta por codigo</a></li>
                            <li><a href="buscarXFecha.php"><span class="icon"></span> Buscar venta por fecha</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a><span class="icon"></span> Movimientos en caja</a>
                        <ul class="submenu">
                            <li><a href="nuevoMovimiento.php"><span class="icon"></span> Nueva Movimineto</a></li>
                            <li><a href="movimientosRealizados.php"><span class="icon"></span> Movimientos realizados</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a><span class="icon"></span> Reportes</a>
                        <ul class="submenu">
                            <li><a href="#"><span class="icon"></span> Reportes de Venta</a></li>
                            <li><a href="reporteInventario.php"><span class="icon"></span> Reportes de Inventario</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a><span class="icon"></span> Configuracion</a>
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
                    <h1>DASHBOARD</h1>
                    <p>Bienvenid@ <strong>"Nombre del usuario"</strong></p>
                </div>
                <div class="user-actions">
                    <span class="icon"></span>
                    <span class="icon"></span>
                    <span class="icon">POWER</span>
                </div>
            </header>
            <section class="dashboard-widgets">
                <div class="widget-row">
                    <a href="#" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>CAJAS</h3>
                    </a>
                    <a href="#" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>CATEGORIAS</h3>
                    </a>
                    <a href="#" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>USUARIOS</h3>
                    </a>
                    <a href="#" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>PRODUCTOS</h3>
                    </a>
                    <a href="#" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>MOVIMIENTOS</h3>
                    </a>
                    <a href="#" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>VENTAS</h3>
                    </a>
                </div>
                <div class="widget-row">
                    <a href="#" class="widget large-widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>REPORTES</h3>
                    </a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>