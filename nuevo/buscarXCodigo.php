<?php
// Incluimos el archivo de conexión a la base de datos
include 'conexionbd.php';

$busqueda_realizada = false;
$id_venta = '';
$resultados = [];

// Verificar si se ha enviado el formulario con un código de venta
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id_venta'])) {
    $busqueda_realizada = true;
    $id_venta = $_POST['id_venta'];

    // Consulta SQL con JOIN para obtener los datos de la venta y el vendedor
    $sql = "SELECT 
                v.id_venta,  
                v.fecha_venta, 
                v.total, 
                u.nombres, 
                u.apellidos 
            FROM ventas AS v
            JOIN usuarios AS u ON v.id_usuario = u.id_usuario
            WHERE v.id_venta = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $id_venta);
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
                    <h1>VENTAS</h1>
                </div>
                
            </header>
            <div class="page-content nueva-venta-layout">
                <div class="venta-main-column">
                    <nav class="page-tabs venta-tabs">
                        <ul>
                            <li><a href="nuevaVenta.php"><span class="icon"></span> NUEVA VENTA</a></li>
                            <li><a href="ventasRealizadas.php"><span class="icon"></span> VENTAS REALIZADAS</a></li>
                            <li><a href="buscarXFecha.php"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                            <li><a href="buscarXCodigo.php" class="tab-active"><span class="icon"></span> BUSCAR VENTA (CODIGO)</a></li>
                        </ul>
                    </nav>
                    <div class="report-generator-panel">
                    <form action="buscarXCodigo.php" method="POST">
                        <div class="form-group report-filter-group">
                            <label for="codigo_venta" class="sr-only">Introduzca el código de la venta</label>
                            <input type="text" id="codigo_venta" name="codigo_venta" placeholder="Introduzca el código de la venta" value="<?php echo htmlspecialchars($id_venta); ?>" required>
                        </div>
                        <div class="report-actions">
                            <button type="submit" class="btn btn-primary btn-generate-report">
                                <span class="icon">🔍</span> BUSCAR
                            </button>
                        </div>
                    </form>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FECHA</th>
                                <th>VENDEDOR</th>
                                <th>TOTAL</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($busqueda_realizada): ?>
                                <?php if ($resultados && $resultados->num_rows > 0): ?>
                                    <?php while($venta = $resultados->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($venta['id_venta']); ?></td>
                                            <td><?php echo date("d/m/Y h:i A", strtotime($venta['fecha_venta'])); ?></td>
                                            <td><?php echo htmlspecialchars($venta['nombres'] . ' ' . $venta['apellidos']); ?></td>
                                            <td style="font-weight: bold;">$<?php echo number_format($venta['total'], 2); ?></td>
                                            <td>
                                                <a href="eliminarVenta.php?id=<?php echo $venta['id_venta']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta?');">🗑️</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5">No se encontró ninguna venta con el código "<?php echo htmlspecialchars($codigo_buscado); ?>".</td></tr>
                                <?php endif; ?>
                            <?php else: ?>
                                <tr><td colspan="5">Introduzca un código de venta para buscar.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>