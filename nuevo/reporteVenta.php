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
                            <li><a href="nuevoCliente.php"><span class="icon"></span> Nuevo cliente</a></li>
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
                </div>
                <div class="dashboard-title">
                    <h1>REPORTES</h1>
                </div>
                <div class="user-actions">
                    <span class="icon">POWER</span>
                </div>
            </header>
<section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon">💲</span> REPORTES DE VENTAS</h2>
                    <p>En el modulo REPORTES podra ver, generar el reportes de ventas.</p>
                </div>
                <div class="stats-panel">
                    <h3>Estadisticas de ventas de hoy *dia que se realiza*</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">VENTAS REALIZADAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">TOTAL EN VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">COSTO DE VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">GANANCIAS</span>
                            <span class="stat-value stat-profit">**</span>
                        </div>
                    </div>
                </div>
                <div class="report-generator-panel">
                    <h3>Generar reporte personalizado</h3>
                    <form action="#" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fecha_inicial">Fecha inicial (dia/mes/año)</label>
                                <div class="input-with-icon">
                                    <input type="text" id="fecha_inicial" name="fecha_inicial" placeholder="dd/mm/aaaa">
                                    <span class="icon-field">📅</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fecha_final">Fecha final (dia/mes/año)</label>
                                <div class="input-with-icon">
                                    <input type="text" id="fecha_final" name="fecha_final" placeholder="dd/mm/aaaa">
                                    <span class="icon-field">📅</span>
                                </div>
                            </div>
                        </div>
                        <div class="report-actions">
                            <button type="submit" class="btn btn-primary btn-generate-report">
                                <span class="icon">⚙️</span> GENERAR REPORTE
                            </button>
                        </div>
                                        <div class="stats-panel">
                    <h3>Ventas del dia *dia que se escoge* al *segindo dia que se escoge*</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">VENTAS REALIZADAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">TOTAL EN VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">COSTO DE VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">GANANCIAS</span>
                            <span class="stat-value stat-profit">**</span>
                        </div>
                    </div>
                </div>
                    </form>
                </div>
            </section>
            </main>
    </div>
</body>
</html>