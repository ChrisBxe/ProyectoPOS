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
                            <li><a href="#"><span class="icon"></span> Productos en Almacen</a></li>
                            <li><a href="#"><span class="icon"></span> Productos en stok minimo</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar Producto</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a><span class="icon"></span> Ventas</a>
                        <ul class="submenu">
                            <li><a href="nuevaVenta.php"><span class="icon"></span> Nueva Venta</a></li>
                            <li><a href="#"><span class="icon"></span> Ventas realizadas</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar venta por codigo</a></li>
                            <li><a href="#"><span class="icon"></span> Buscar venta por fecha</a></li>
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
                            <li><a href="datos"><span class="icon"></span> Datos</a></li>
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
                    <h1>CONFIGURACIONES</h1> </div>
                <div class="user-actions">
                    <span class="icon"></span>
                    <span class="icon"></span>
                    <span class="icon">POWER</span>
                </div>
            </header>

            <section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon"></span> DATOS DE LA EMPRESA</h2> <p>En el modulo EMPRESA usted puede registrar los datos de su compañia, negocio u organizacion. Una vez que registre los datos de su empresa solo podra actualizarlos en caso quiera cambiar algun dato, ya no sera necesario registrarlos nuevamente.</p>
                </div>

                <form action="#" method="post">
                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Datos de la empresa</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="empresa_tipo_documento">Tipo de documento</label>
                                <div class="input-with-icon">
                                    <input type="text" id="empresa_tipo_documento" name="empresa_tipo_documento" value="">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="empresa_numero_documento">Numero de documento</label>
                                <div class="input-with-icon">
                                    <input type="text" id="empresa_numero_documento" name="empresa_numero_documento" value="">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="empresa_nombre">Nombre</label>
                                 <div class="input-with-icon">
                                    <input type="text" id="empresa_nombre" name="empresa_nombre" value="">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-group-fullwidth">
                                <label for="empresa_direccion">Direccion</label>
                                <input type="text" id="empresa_direccion" name="empresa_direccion" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Informacion de contacto</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="empresa_telefono">Telefono</label>
                                <input type="text" id="empresa_telefono" name="empresa_telefono" value="">
                            </div>
                            <div class="form-group">
                                <label for="empresa_email">Email</label>
                                <input type="email" id="empresa_email" name="empresa_email" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Informacion de impuestos</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="empresa_nombre_impuesto">Nombre de impuesto</label>
                                 <div class="input-with-icon">
                                    <input type="text" id="empresa_nombre_impuesto" name="empresa_nombre_impuesto" value="">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="empresa_impuesto_porcentaje">Impuesto porcentaje %</label>
                                <div class="input-with-icon">
                                    <input type="text" id="empresa_impuesto_porcentaje" name="empresa_impuesto_porcentaje" value="">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-group-fullwidth">
                                <label>¿Mostrar impuestos en facturas y tickets?</label>
                                <div class="radio-group">
                                    <label class="radio-label"><input type="radio" name="mostrar_impuestos" value="si" checked> Si</label>
                                    <label class="radio-label"><input type="radio" name="mostrar_impuestos" value="no"> No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions-main">
                        <button type="submit" class="btn btn-success">
                            <span class="icon"></span> ACTUALIZAR
                        </button>
                        <p class="form-note">Los campos marcados con <strong>*</strong> son obligatorios</p>
                    </div>
                </form>
            </section>
            </main>
    </div>
</body>
</html>