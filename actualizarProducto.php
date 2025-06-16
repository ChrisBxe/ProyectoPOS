<?php
// Incluir la conexión a la base de datos
include 'conexionbd.php';

$id_producto = null;
$producto = null;
$mensaje = '';

// 1. OBTENER EL ID DEL PRODUCTO
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
} elseif (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
} else {
    die("Error: No se ha especificado un ID de producto.");
}


// 2. PROCESAR EL FORMULARIO (CUANDO SE ENVÍA POR POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger todos los datos del formulario
    $nombre = $_POST['nombre_producto'];
    $stock = $_POST['stock_existencias'];
    $stock_minimo = $_POST['stock_minimo'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $categoria = $_POST['categoria_producto'];
    $garantia = $_POST['tiempo_garantia'];
    $estado = $_POST['estado_producto'];
    $nombre_foto_actual = $_POST['nombre_foto_actual'];
    
    $nombre_foto_nueva = $nombre_foto_actual;

    // Lógica para manejar la subida de una nueva imagen
    if (isset($_FILES['foto_producto']) && $_FILES['foto_producto']['error'] === 0) {
        $foto = $_FILES['foto_producto'];
        $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
        if (in_array($foto['type'], $permitidos) && $foto['size'] <= 3145728) { // 3MB
            $nombre_foto_nueva = uniqid() . "_" . basename($foto['name']);
            $ruta_destino = "img_productos/" . $nombre_foto_nueva;
            
            if (move_uploaded_file($foto['tmp_name'], $ruta_destino)) {
                if (!empty($nombre_foto_actual) && file_exists("img_productos/" . $nombre_foto_actual)) {
                    unlink("img_productos/" . $nombre_foto_actual);
                }
            } else {
                $nombre_foto_nueva = $nombre_foto_actual;
            }
        }
    }

    // Consulta SQL para actualizar el producto
    $sql = "UPDATE productos SET
                nombre_producto = ?,
                stock = ?,
                stock_minimo = ?,
                precio_compra = ?,
                precio_venta = ?,
                id_categoria = ?,
                garantia_meses = ?,
                estado = ?,
                imagen = ?
            WHERE id_producto = ?";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    
    $stmt->bind_param("ssiiddissi", 
            $nombre,            // s
            $stock,             // i
            $stock_minimo,      // i
            $precio_compra,     // d
            $precio_venta,      // d
            $categoria,         // i
            $garantia,          // s
            $estado,            // s
            $nombre_foto_nueva, // s
            $id_producto        // i
        );

    if ($stmt->execute()) {
        echo "<script>alert('Producto actualizado exitosamente.'); window.location.href='ProductosAlmacen.php';</script>";
        exit();
    } else {
        $mensaje = "Error al actualizar el producto: " . $stmt->error;
    }
    $stmt->close();
}


// 3. OBTENER LOS DATOS ACTUALES DEL PRODUCTO PARA MOSTRAR EN EL FORMULARIO
$sql_fetch = "SELECT * FROM productos WHERE id_producto = ?";
$stmt_fetch = $conexion->prepare($sql_fetch);
$stmt_fetch->bind_param("i", $id_producto);
$stmt_fetch->execute();
$resultado = $stmt_fetch->get_result();

if ($resultado->num_rows === 1) {
    $producto = $resultado->fetch_assoc();
} else {
    die("Producto no encontrado.");
}
$stmt_fetch->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Actualizar Producto</title>
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
                        <a href="#"><span class="icon">📦</span> Productos</a>
                        <ul class="submenu">
                            <li><a href="nuevoProducto.php">Nuevo Producto</a></li>
                            <li><a href="ProductosAlmacen.php">Productos en Almacen</a></li>
                            <li><a href="productoMinStock.php">Productos en stock minimo</a></li>
                            <li><a href="buscarProducto.php">Buscar Producto</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="top-bar">
                <div class="dashboard-title">
                    <h1>ACTUALIZAR PRODUCTO</h1>
                </div>
            </header>
            <section class="page-content">
                <?php if ($mensaje): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($mensaje); ?></p>
                <?php endif; ?>

                <form action="actualizarProducto.php" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
                    <input type="hidden" name="nombre_foto_actual" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                    <input type="hidden" name="descripcion_producto" value="<?php echo htmlspecialchars($producto['descripcion']); ?>">


                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Información del producto</h3>
                        <div class="form-row">
                            <div class="form-group form-group-fullwidth">
                                <label for="nombre_producto">Nombre</label>
                                <input type="text" id="nombre_producto" name="nombre_producto" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="stock_existencias">Stock o existencias</label>
                                <input type="number" id="stock_existencias" name="stock_existencias" value="<?php echo htmlspecialchars($producto['stock']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="stock_minimo">Stock mínimo</label>
                                <input type="number" id="stock_minimo" name="stock_minimo" value="<?php echo htmlspecialchars($producto['stock_minimo']); ?>">
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="form-group">
                                <label for="precio_compra">Precio de compra</label>
                                <input type="text" id="precio_compra" name="precio_compra" value="<?php echo htmlspecialchars($producto['precio_compra']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="precio_venta">Precio de venta</label>
                                <input type="text" id="precio_venta" name="precio_venta" value="<?php echo htmlspecialchars($producto['precio_venta']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Categoría & Estado</h3>
                         <div class="form-row">
                             <div class="form-group">
                                <label for="categoria_producto">Categoría</label>
                                <select id="categoria_producto" name="categoria_producto">
                                    <option value="1" <?php echo ($producto['id_categoria'] == 1) ? 'selected' : ''; ?>>General</option>
                                </select>
                             </div>
                             <div class="form-group">
                                <label for="estado_producto">Estado del producto</label>
                                <select id="estado_producto" name="estado_producto">
                                    <option value="habilitado" <?php echo ($producto['estado'] == 'habilitado') ? 'selected' : ''; ?>>Habilitado</option>
                                    <option value="deshabilitado" <?php echo ($producto['estado'] == 'deshabilitado') ? 'selected' : ''; ?>>Deshabilitado</option>
                                </select>
                             </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Garantía del producto</h3>
                        <div class="form-row">
                             <div class="form-group">
                                <label for="tiempo_garantia">Garantía (meses)</label>
                                <input type="text" id="tiempo_garantia" name="tiempo_garantia" value="<?php echo htmlspecialchars($producto['garantia_meses']); ?>">
                             </div>
                        </div>
                    </div>
                    
                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Foto o imagen del producto</h3>
                        <div style="margin-bottom: 15px;">
                            <p>Imagen actual:</p>
                            <?php if(!empty($producto['imagen'])): ?>
                                <img src="img_productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen actual" style="max-width: 150px; border-radius: 5px;">
                            <?php else: ?>
                                <p>No hay imagen asignada.</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group form-group-fullwidth">
                            <label for="foto_producto">Seleccionar nueva imagen (opcional)</label>
                            <input type="file" id="foto_producto" name="foto_producto" class="file-input">
                            <p class="file-input-note">Dejar en blanco para conservar la imagen actual.</p>
                        </div>
                    </div>

                    <div class="form-actions-main">
                        <button type="submit" class="btn btn-primary"><span class="icon"></span> ACTUALIZAR PRODUCTO</button>
                        <a href="ProductosAlmacen.php" class="btn btn-secondary">CANCELAR</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>