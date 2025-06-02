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
                <div class="menu-toggle">
                    <span class="icon">☰</span>
                </div>
                <div class="dashboard-title">
                    <h1>MOVIMIENTOS EN CAJAS</h1> </div>
                <div class="user-actions">
                    <span class="icon">🔔</span>
                    <span class="icon">🔄</span>
                    <span class="icon">POWER</span>
                </div>
            </header>

            <section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon">💵</span> NUEVO MOVIMIENTO</h2> <p>En el modulo MOVIMIENTOS usted puede realizar, buscar y ver todos los movimientos de efectivo realizados en las cajas de ventas. Los movimientos de "Entrada de efectivo" son aquellos donde se ingresa dinero a las cajas de ventas. Los movimientos de "Retiro de efectivo" son aquellos donde se extrae el dinero de las cajas de ventas.</p>
                </div>

                <nav class="page-tabs">
                    <ul>
                        <li><a href="nuevoMovimiento.php" class="tab-active"><span class="icon">➕</span> NUEVO MOVIMIENTO</a></li>
                        <li><a href="movimientosRealizados.php"><span class="icon">🧾</span> MOVIMIENTOS REALIZADOS</a></li>
                    </ul>
                </nav>

                <form action="#" method="post">
                    <div class="form-panel">
                        <h3><span class="icon section-icon">ℹ️</span> Informacion del movimiento</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="movimiento_caja">Caja</label>
                                <div class="input-with-icon">
                                    <select id="movimiento_caja" name="movimiento_caja">
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        <option value="caja1">Caja Principal #10000</option>
                                        <option value="caja2">Caja Secundaria #10001</option>
                                    </select>
                                    <span class="icon-field">🛒</span> </div>
                            </div>
                            <div class="form-group">
                                <label for="movimiento_tipo">Tipo de movimiento</label>
                                <div class="input-with-icon">
                                    <select id="movimiento_tipo" name="movimiento_tipo">
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        <option value="entrada">Entrada de efectivo</option>
                                        <option value="retiro">Retiro de efectivo</option>
                                    </select>
                                    <span class="icon-field">⇆</span> </div>
                            </div>
                            <div class="form-group">
                                <label for="movimiento_cantidad">Cantidad de efectivo</label>
                                <div class="input-with-icon">
                                    <input type="text" id="movimiento_cantidad" name="movimiento_cantidad" value="0.00" placeholder="0.00">
                                    <span class="icon-field">💰</span> </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-group-fullwidth"> <label for="movimiento_motivo">Motivo del movimiento</label>
                                <div class="input-with-icon">
                                     <input type="text" id="movimiento_motivo" name="movimiento_motivo" placeholder="Describa brevemente el motivo del movimiento de efectivo">
                                     <span class="icon-field">📝</span> </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions-main">
                        <button type="reset" class="btn btn-secondary"><span class="icon">🧹</span> LIMPIAR</button>
                        <button type="submit" class="btn btn-primary"><span class="icon">💾</span> GUARDAR</button>
                        <p class="form-note">Los campos marcados con <strong>*</strong> son obligatorios</p>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>