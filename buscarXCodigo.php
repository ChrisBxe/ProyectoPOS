<?php
// Incluimos el archivo de conexión a la base de datos
include 'conexionbd.php';

$busqueda_realizada = false;
$id_buscado = '';
$resultados = [];

// Verificar si se ha enviado el formulario con un ID de venta
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id_venta_busqueda'])) {
    $busqueda_realizada = true;
    $id_buscado = $_POST['id_venta_busqueda'];

    // Consulta SQL con JOIN para obtener los datos de la venta y el vendedor
    $sql = "SELECT 
                *
            FROM ventas
            WHERE id_venta = ?";

    $stmt = $conexion->prepare($sql);
    // Vincular el ID como un entero (i)
    $stmt->bind_param("i", $id_buscado);
    $stmt->execute();
    $resultados = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gengaras - Buscar Venta por ID</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .status { padding: 5px 10px; border-radius: 15px; color: white; font-weight: bold; font-size: 0.8em; text-transform: uppercase; }
        .status-realizada { background-color: #28a745; }
        .status-pendiente { background-color: #ffc107; color: #343A40; }
        .status-cancelada { background-color: #dc3545; }
        .action-icon { text-decoration: none; font-size: 1.2em; margin: 0 5px; }
        .data-table td, .data-table th { text-align: center; vertical-align: middle; }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>

        <main class="main-content">
            <header class="top-bar">
                <div class="dashboard-title">
                    <h1>VENTAS</h1>
                </div>
            </header>
            <div class="page-content">
                <nav class="page-tabs venta-tabs">
                    <ul>
                        <li><a href="nuevaVenta.php"><span class="icon"></span> NUEVA VENTA</a></li>
                        <li><a href="ventasRealizadas.php"><span class="icon"></span> VENTAS REALIZADAS</a></li>
                        <li><a href="buscarXFecha.php"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                        <li><a href="buscarXCodigo.php" class="tab-active"><span class="icon"></span> BUSCAR VENTA (ID)</a></li>
                    </ul>
                </nav>
                <div class="report-generator-panel">
                    <form action="buscarXCodigo.php" method="POST">
                        <div class="form-group report-filter-group">
                            <label for="id_venta_busqueda" class="sr-only">Introduzca el ID de la venta</label>
                            <input type="number" id="id_venta_busqueda" name="id_venta_busqueda" placeholder="Introduzca el ID de la venta" value="<?php echo htmlspecialchars($id_buscado); ?>" required>
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
                                        <td class="total-amount">$<?php echo number_format($venta['total'], 2); ?></td>
                                        <td>
                                            <a href="eliminarVenta.php?id=<?php echo $venta['id_venta']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta? Esta acción no se puede deshacer.');">🗑️</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="4">No se encontró ninguna venta con el ID "<?php echo htmlspecialchars($id_buscado); ?>".</td></tr>
                                <?php endif; ?>
                            <?php else: ?>
                                <tr><td colspan="4">Introduzca un ID de venta para buscar.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <?php
        if(isset($stmt)) {
            $stmt->close();
        }
        $conexion->close();
    ?>
</body>
</html>