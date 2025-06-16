<?php
// Incluimos el archivo de conexión a la base de datos
include 'conexionbd.php';

// Inicializamos las variables para la búsqueda
$busqueda_realizada = false;
$termino_busqueda = '';
$resultados = [];

// Comprobar si se ha enviado el formulario con un término de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['termino_busqueda'])) {
    $busqueda_realizada = true;
    $termino_busqueda = $_POST['termino_busqueda'];

    // Preparamos el término para la consulta LIKE
    $like_termino = "%" . $termino_busqueda . "%";

    // Consulta para buscar por código de barras O por nombre de producto
    $sql = "SELECT id_producto, imagen, codigo_producto, nombre_producto, precio_venta, stock, fecha_vencimiento, estado 
            FROM productos 
            WHERE codigo_producto LIKE ? OR nombre_producto LIKE ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $like_termino, $like_termino);
    $stmt->execute();
    $resultados = $stmt->get_result();
}
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
                    <h1>ADMINISTRACION</h1>
                </div>
                
            </header>
            <section class="page-content">
                <nav class="page-tabs"> <ul>
                        <li><a href="nuevoProducto.php"><span class="icon"></span> NUEVO PRODUCTO</a></li>
                        <li><a href="ProductosAlmacen.php"><span class="icon"></span> PRODUCTOS EN ALMACEN</a></li>
                        <li><a href="productoMinStock.php"><span class="icon"></span> PRODUCTOS EN STOCK MINIMO</a></li>
                        <li><a href="buscarProducto.php"  class="tab-active"><span class="icon"></span> BUSCAR PRODUCTO</a></li>
                    </ul>
                </nav>
                <div class="report-generator-panel">
                    <form action="buscarProducto.php" method="POST">
                        <div class="form-group report-filter-group">
                            <label for="termino_busqueda" class="sr-only">Introduzca el código o nombre del producto</label>
                            <input type="text" id="termino_busqueda" name="termino_busqueda" placeholder="Introduzca el código o nombre del producto" value="<?php echo htmlspecialchars($termino_busqueda); ?>">
                        </div>
                        <div class="report-actions">
                            <button type="submit" class="btn btn-primary btn-generate-report">
                                <span class="icon">🔍</span> BUSCAR
                            </button>
                        </div>
                    </form>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>IMAGEN</th>
                            <th>CÓDIGO BARRAS</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>DISPONIBILIDAD</th>
                            <th>VENCIMIENTO</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($busqueda_realizada): ?>
                            <?php if ($resultados && $resultados->num_rows > 0): ?>
                                <?php while($producto = $resultados->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($producto['imagen'])): ?>
                                                <img src="img_productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" class="product-image">
                                            <?php else: ?>
                                                <img src="img_productos/default.png" alt="Sin imagen" class="product-image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($producto['codigo_producto']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
                                        <td>$<?php echo number_format($producto['precio_venta'], 2); ?></td>
                                        <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['fecha_vencimiento'] ? date("d/m/Y", strtotime($producto['fecha_vencimiento'])) : 'N/A'); ?></td>
                                        <td>
                                            <?php if ($producto['estado'] == 'habilitado'): ?>
                                                <span class="status status-active">HABILITADO</span>
                                            <?php else: ?>
                                                <span class="status status-inactive">DESHABILITADO</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="actualizarProducto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon action-edit" title="Actualizar"><span class="icon">✏️</span></a>
                                            <a href="eliminarProducto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');"><span class="icon">🗑️</span></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="8">No se encontraron productos que coincidan con "<?php echo htmlspecialchars($termino_busqueda); ?>".</td></tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr><td colspan="8">Introduzca un término de búsqueda para ver los resultados.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>

<?php
if (isset($stmt)) {
    $stmt->close();
}
$conexion->close();
?>
