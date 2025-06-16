<?php
include 'conexionbd.php';
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
        <?php
session_start();
include 'sidebar.php';
?>
        <main class="main-content">
            <header class="top-bar">
                <div class="dashboard-title">
                    <h1>PRODUCTOS</h1>
                </div>
                
            </header>
            <section class="page-content">
                <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado'): ?>
    <div class="alert success">✅ Producto eliminado correctamente.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'fk'): ?>
    <div class="alert error">⚠️ No se puede eliminar el producto porque está relacionado con otras tablas (por ejemplo, ventas).</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>
    <div class="alert error">❌ El producto no fue encontrado.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'noid'): ?>
    <div class="alert error">⚠️ No se proporcionó un ID válido.</div>
<?php endif; ?>

                <nav class="page-tabs"> <ul>
                        <li><a href="nuevoProducto.php"><span class="icon"></span> NUEVO PRODUCTO</a></li>
                        <li><a href="porductosAlmacen.php"  class="tab-active"><span class="icon"></span> PRODUCTOS EN ALMACEN</a></li>
                        <li><a href="productoMinStock.php"><span class="icon"></span> PRODUCTOS EN STOCK MINIMO</a></li>
                        <li><a href="buscarProducto.php"><span class="icon"></span> BUSCAR PRODUCTO</a></li>
                    </ul>
                </nav>
                <table class="data-table">
                        <thead>
                            <tr>
                                <th>IMAGEN</th>
                                <th>CODIGO BARRAS</th>
                                <th>NOMBRE</th>
                                <th>PRECIO</th>
                                <th>DISPONIBILIDAD</th>
                                <th>ESTADO</th>
                                <th>ACTUALIZAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT id_producto, imagen, codigo_producto, nombre_producto, precio_venta, stock, fecha_vencimiento, estado FROM productos ORDER BY nombre_producto ASC"; //
                        $resultado = $conexion->query($sql);

                        if ($resultado->num_rows > 0) {
                            while($producto = $resultado->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($producto['imagen'])): ?>
                                            <img src="img_productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" class="product-image">
                                        <?php else: ?>
                                            <img src="img_productos/default.png" alt="Sin imagen" class="product-image"> <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($producto['codigo_producto']); ?></td>
                                    <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
                                    <td>$<?php echo number_format($producto['precio_venta'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                                    <td>
                                        <?php if ($producto['estado'] == 'habilitado'): ?>
                                            <span class="status status-active">HABILITADO</span>
                                        <?php else: ?>
                                            <span class="status status-inactive">DESHABILITADO</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="actualizarProducto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon action-edit" title="Actualizar"><span class="icon">✏️</span></a>
                                    </td>
                                    <td>
                                        <a href="eliminarProducto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?');"><span class="icon">🗑️</span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="8">No hay productos registrados en el almacén.</td></tr>';
                        }
                        $conexion->close();
                        ?>
                    </tbody>
                    </table>
            </section>
        </main>
    </div>
</body>
</html>