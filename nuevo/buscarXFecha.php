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
                            <li><a href="ventasRealizadas.php"><span class="icon"></span> VENTAS REALIZADAS</a></li>
                            <li><a href="ventasPendientes.php"><span class="icon"></span> VENTAS PENDIENTES</a></li>
                            <li><a href="buscarXFecha.php" class="tab-active"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                            <li><a href="buscarXCodigo.php"><span class="icon"></span> BUSCAR VENTA (CODIGO)</a></li>
                        </ul>
                    </nav>
                    <form method="POST" action="buscarXFecha.php" class="search-form">
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
                                <span class="icon">⚙️</span> BUSCAR VENTA
                            </button>
                        </div>
                    </form>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NUMERO VENTA</th>
                                <th>FECHA</th>
                                <th>VENDEDOR</th>
                                <th>TOTAL</th>
                                <th>ESTADO</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>**</td>
                                <td>**</td>
                                <td>**</td>
                                <td>**</td>
                                <td>**</td>
                                <td><span class="status status-active">REALIZADA</span></td>
                                <td><a href="#" class="action-icon action-delete" title="Eliminar"><span class="icon">🗑️</span></a></td>
                            </tr>
                            </tbody>
                    </table>
            </div>
        </main>
    </div>
</body>
</html>