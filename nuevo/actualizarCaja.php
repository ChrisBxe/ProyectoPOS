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
                <div class="form-panel">
                    <h3><span class="icon section-icon"></span> Informacion de la caja</h3>
                    <form action="#" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="numero_caja">Numero de caja</label>
                                <div class="input-with-icon">
                                    <input type="text" id="numero_caja" name="numero_caja" value="">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_codigo_caja">Nombre o codigo de caja</label>
                                <div class="input-with-icon">
                                    <input type="text" id="nombre_codigo_caja" name="nombre_codigo_caja" placeholder="Ej: Caja Principal">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="estado_caja">Estado de la caja</label>
                                <select id="estado_caja" name="estado_caja">
                                    <option value="habilitada" selected>Habilitada</option>
                                    <option value="deshabilitada">Deshabilitada</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="efectivo_caja">Efectivo en caja</label>
                                <input type="text" id="efectivo_caja" name="efectivo_caja" value="0.00" placeholder="0.00">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><span class="icon"></span> GUARDAR</button>
                        </div>
                    </form>
                </div>
            </section>
            </main>
    </div>
</body>
</html>