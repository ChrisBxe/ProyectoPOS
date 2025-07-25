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
        <?php
session_start();
include 'sidebar.php';
?>

        <main class="main-content">
            <header class="top-bar">
                <div class="menu-toggle">
                    <span class="icon"></span>
                </div>
                <div class="dashboard-title">
                    <h1>PRODUCTOS</h1>
                </div>
                <div class="user-actions">
                    <span class="icon"></span>
                    <span class="icon"></span>
                    <span class="icon"></span>
                </div>
            </header>
            <section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon"></span> NUEVO PRODUCTO</h2>
                    <p>En el modulo PRODUCTOS podra agregar nuevos productos al sistema, actualizar datos de los productos, eliminar o actualizar la imagen de los productos, imprimir codigos de barras o SKU de cada producto, buscar productos en el sistema, ver todos los productos en almacen, ver los productos mas vendido y filtrar productos por categoria.</p>
                </div>

                <nav class="page-tabs"> <ul>
                        <li><a href="nuevoProducto.php" class="tab-active"><span class="icon"></span> NUEVO PRODUCTO</a></li>
                        <li><a href="productosAlmacen.php"><span class="icon"></span> PRODUCTOS EN ALMACEN</a></li>
                        <li><a href="productoMinStock.php"><span class="icon"></span> PRODUCTOS EN STOCK MINIMO</a></li>
                        <li><a href="buscarProducto.php"><span class="icon"></span> BUSCAR PRODUCTO</a></li>
                    </ul>
                </nav>

                <form action="agregarProducto.php" method="POST" enctype="multipart/form-data">
                    <div class="form-panel">
                        <h3><span class="icon section-icon"><y_bin_226></span> Codigo</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="codigo_barras">Codigo de producto</label>
                                <div class="input-with-icon">
                                    <input type="text" id="codigo_producto" name="codigo_producto" placeholder="Escanear o ingresar codigo">
                                    <span class="icon-field"><y_bin_226></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Informacion del producto</h3>
                        <div class="form-row">
                            <div class="form-group form-group-fullwidth"> <label for="nombre_producto">Nombre</label>
                                 <div class="input-with-icon">
                                    <input type="text" id="nombre_producto" name="nombre_producto" placeholder="Nombre del producto">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="stock_existencias">Stock o existencias</label>
                                <input type="number" id="stock_existencias" name="stock_existencias" placeholder="Cantidad actual">
                            </div>
                            <div class="form-group">
                                <label for="stock_minimo">Stock minimo</label>
                                <div class="input-with-icon">
                                    <input type="number" id="stock_minimo" name="stock_minimo" placeholder="Cantidad minima">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="presentacion_producto">Presentacion del producto</label>
                                <div class="input-with-icon">
                                    <select id="presentacion_producto" name="presentacion_producto">
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        <option value="unidad">Unidad</option>
                                        <option value="caja">Caja</option>
                                        <option value="paquete">Paquete</option>
                                    </select>
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="precio_compra">Precio de compra (Con impuesto incluido)</label>
                                <div class="input-with-icon">
                                    <input type="text" id="precio_compra" name="precio_compra" value="0.00" placeholder="0.00">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="precio_venta">Precio de venta (Con impuesto incluido)</label>
                                <div class="input-with-icon">
                                    <input type="text" id="precio_venta" name="precio_venta" value="0.00" placeholder="0.00">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="precio_mayoreo">Precio de venta por mayoreo (Con impuesto incluido)</label>
                                <div class="input-with-icon">
                                    <input type="text" id="precio_mayoreo" name="precio_mayoreo" value="0.00" placeholder="0.00">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                             <div class="form-group">
                                <label for="descuento_venta">Descuento (%) en venta</label>
                                <div class="input-with-icon">
                                    <input type="number" id="descuento_venta" name="descuento_venta" value="0" placeholder="0">
                                    <span class="icon-field"></span>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label for="marca_producto">Marca</label>
                                <input type="text" id="marca_producto" name="marca_producto" placeholder="Marca del producto">
                            </div>
                            <div class="form-group">
                                <label for="modelo_producto">Modelo</label>
                                <input type="text" id="modelo_producto" name="modelo_producto" placeholder="Modelo del producto">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Garantia de fabrica</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unidad_tiempo_garantia">Unidad de tiempo</label>
                                <input type="number" id="unidad_tiempo_garantia" name="unidad_tiempo_garantia" value="0" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="tiempo_garantia">Tiempo de garantia</label>
                                <div class="input-with-icon">
                                    <select id="tiempo_garantia" name="tiempo_garantia">
                                        <option value="N/A" selected>N/A</option>
                                        <option value="dias">Dias</option>
                                        <option value="meses">Meses</option>
                                        <option value="anos">Años</option>
                                    </select>
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Categoria & estado</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="categoria_producto">Categoria</label>
                                 <div class="input-with-icon">
                                    <select id="categoria_producto" name="categoria_producto">
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        <option value="1">General</option>
                                    </select>
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="estado_producto">Estado del producto</label>
                                <select id="estado_producto" name="estado_producto">
                                    <option value="habilitado" selected>Habilitado</option>
                                    <option value="deshabilitado">Deshabilitado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions-main">
                        <button type="reset" class="btn btn-secondary"><span class="icon"></span> LIMPIAR</button>
                        <button type="submit" class="btn btn-primary"><span class="icon"></span> GUARDAR</button>
                        <p class="form-note">Los campos marcados con <strong>*</strong> son obligatorios</p>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>