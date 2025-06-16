<?php
// Incluir la conexión a la base de datos
include 'conexionbd.php';

$id_categoria = null;
$categoria = null;
$mensaje = '';

// 1. OBTENER EL ID DE LA CATEGORÍA
// Se intenta obtener desde POST (al guardar) y si no, desde GET (al cargar la página)
if (isset($_POST['id_categoria'])) {
    $id_categoria = $_POST['id_categoria'];
} elseif (isset($_GET['id'])) {
    $id_categoria = $_GET['id'];
} else {
    die("Error: No se ha especificado un ID de categoría.");
}

// 2. PROCESAR EL FORMULARIO (MÉTODO POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $nombre_categoria = $_POST['nombre_categoria'];
    $ubicacion_categoria = $_POST['ubicacion_categoria'];
    $estado_categoria = $_POST['estado'];

    // Validar que el nombre no esté vacío
    if (empty($nombre_categoria)) {
        $mensaje = "Error: El nombre de la categoría no puede estar vacío.";
    } else {
        // Validar si el nombre de la categoría ya existe en OTRA categoría
        $sql_check = "SELECT id_categoria FROM categorias WHERE nombre_categoria = ? AND id_categoria != ?";
        $stmt_check = $conexion->prepare($sql_check);
        $stmt_check->bind_param("si", $nombre_categoria, $id_categoria);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $mensaje = "Error: Ya existe otra categoría con ese nombre.";
        } else {
            // Si todo es correcto, proceder con la actualización
            $sql_update = "UPDATE categorias SET nombre_categoria = ?, ubicacion_categoria = ?, estado = ? WHERE id_categoria = ?";
            $stmt_update = $conexion->prepare($sql_update);
            $stmt_update->bind_param("sssi", $nombre_categoria, $ubicacion_categoria, $estado_categoria, $id_categoria);

            if ($stmt_update->execute()) {
                echo "<script>alert('Categoría actualizada exitosamente.'); window.location.href='listaCategorias.php';</script>";
                exit();
            } else {
                $mensaje = "Error al actualizar la categoría: " . $stmt_update->error;
            }
            $stmt_update->close();
        }
        $stmt_check->close();
    }
}

// 3. OBTENER DATOS ACTUALES PARA MOSTRAR EN EL FORMULARIO (MÉTODO GET)
$sql_fetch = "SELECT * FROM categorias WHERE id_categoria = ?";
$stmt_fetch = $conexion->prepare($sql_fetch);
$stmt_fetch->bind_param("i", $id_categoria);
$stmt_fetch->execute();
$resultado = $stmt_fetch->get_result();

if ($resultado->num_rows === 1) {
    $categoria = $resultado->fetch_assoc();
} else {
    // Si no se encuentra la categoría, se detiene la ejecución
    die("Categoría no encontrada.");
}
$stmt_fetch->close();
$conexion->close();
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
                
            </header>
            <section class="page-content">
                 <div class="page-header">
                    <h2><span class="icon section-icon"></span> ACTUALIZAR CATEGORÍA</h2>
                    <p>En esta sección puede modificar el nombre, la ubicación y el estado de una categoría existente.</p>
                </div>
                
                <?php if ($mensaje): ?>
                    <p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo htmlspecialchars($mensaje); ?></p>
                <?php endif; ?>

                <div class="form-panel">
                    <h3><span class="icon section-icon"></span> Información de la categoría</h3>
                    
                    <form action="actualizarCategoria.php" method="post">
                        
                        <input type="hidden" name="id_categoria" value="<?php echo htmlspecialchars($categoria['id_categoria']); ?>">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre_categoria">Nombre de la categoría</label>
                                <input type="text" id="nombre_categoria" name="nombre_categoria" value="<?php echo htmlspecialchars($categoria['nombre_categoria']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ubicacion">Pasillo o ubicación</label>
                                <input type="text" id="ubicacion" name="ubicacion" value="<?php echo htmlspecialchars($categoria['ubicacion']); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="estado">Estado de la categoría</label>
                                <select id="estado" name="estado">
                                    <option value="Habilitada" <?php echo ($categoria['estado'] == 'Habilitada') ? 'selected' : ''; ?>>Habilitada</option>
                                    <option value="Deshabilitada" <?php echo ($categoria['estado'] == 'Deshabilitada') ? 'selected' : ''; ?>>Deshabilitada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><span class="icon"></span> ACTUALIZAR</button>
                            <a href="listaCategorias.php" class="btn btn-secondary">CANCELAR</a>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>
</html>