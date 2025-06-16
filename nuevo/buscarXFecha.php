<?php
include 'conexionbd.php';

$busqueda_realizada = false;
$fecha_inicial_str = '';
$fecha_final_str = '';
$resultados = [];
$mensaje_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['fecha_inicial']) && !empty($_POST['fecha_final'])) {
        $busqueda_realizada = true;
        $fecha_inicial_str = $_POST['fecha_inicial'];
        $fecha_final_str = $_POST['fecha_final'];

        // Convertir fechas de dd/mm/aaaa a YYYY-MM-DD para MySQL
        $fecha_inicial_obj = DateTime::createFromFormat('d/m/Y', $fecha_inicial_str);
        $fecha_final_obj = DateTime::createFromFormat('d/m/Y', $fecha_final_str);

        if ($fecha_inicial_obj && $fecha_final_obj) {
            // Formatear para la consulta SQL, incluyendo todo el día
            $fecha_inicial_sql = $fecha_inicial_obj->format('Y-m-d 00:00:00');
            $fecha_final_sql = $fecha_final_obj->format('Y-m-d 23:59:59');

            $sql = "SELECT 
                        v.id_venta, v.fecha_venta, v.total,
                        u.nombres, u.apellidos
                    FROM ventas AS v
                    JOIN usuarios AS u ON v.id_usuario = u.id_usuario
                    WHERE v.fecha_venta BETWEEN ? AND ?
                    ORDER BY v.fecha_venta DESC";

            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $fecha_inicial_sql, $fecha_final_sql);
            $stmt->execute();
            $resultados = $stmt->get_result();
        } else {
            $mensaje_error = "Formato de fecha no válido. Use dd/mm/aaaa.";
        }
    } else {
        $mensaje_error = "Por favor, especifique una fecha inicial y final.";
        $busqueda_realizada = true; // Para mostrar el mensaje de error en la tabla
    }
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
                            <li><a href="buscarXFecha.php" class="tab-active"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                            <li><a href="buscarXCodigo.php"><span class="icon"></span> BUSCAR VENTA (CODIGO)</a></li>
                        </ul>
                    </nav>
                    <form method="POST" action="buscarXFecha.php" class="search-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_inicial">Fecha inicial</label>
                            <input type="text" id="fecha_inicial" name="fecha_inicial" placeholder="dd/mm/aaaa" value="<?php echo htmlspecialchars($fecha_inicial_str); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_final">Fecha final</label>
                            <input type="text" id="fecha_final" name="fecha_final" placeholder="dd/mm/aaaa" value="<?php echo htmlspecialchars($fecha_final_str); ?>" required>
                        </div>
                    </div>
                    <div class="report-actions">
                        <button type="submit" class="btn btn-primary">
                            <span class="icon">🔍</span> BUSCAR VENTAS
                        </button>
                    </div>
                </form>

                 <?php if ($mensaje_error): ?>
                    <p style="color: red; text-align: center; margin-top: 15px;"><?php echo htmlspecialchars($mensaje_error); ?></p>
                <?php endif; ?>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NÚMERO VENTA</th>
                                <th>FECHA</th>
                                <th>VENDEDOR</th>
                                <th>TOTAL</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($busqueda_realizada && empty($mensaje_error)): ?>
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
                                    <tr><td colspan="5">No se encontraron ventas en el rango de fechas seleccionado.</td></tr>
                                <?php endif; ?>
                            <?php elseif(empty($mensaje_error)): ?>
                                <tr><td colspan="5">Seleccione un rango de fechas para buscar.</td></tr>
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