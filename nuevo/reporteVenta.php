<?php
session_start();
include 'conexionbd.php';

// --- LÓGICA DE CÁLCULO ---

// Inicializar variables de estadísticas
$numero_ventas = 0;
$monto_total_ventas = 0.00;
$costo_total_ventas = 0.00;
$ganancias = 0.00;

// Inicializar variables de fecha
$fecha_inicial_str = '';
$fecha_final_str = '';

// Determinar el rango de fechas a consultar
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['fecha_inicial']) && !empty($_POST['fecha_final'])) {
    // Escenario 2: El usuario ha enviado un rango de fechas
    $fecha_inicial_str = $_POST['fecha_inicial'];
    $fecha_final_str = $_POST['fecha_final'];
    
    $titulo_reporte = "Reporte del " . date("d/m/Y", strtotime($fecha_inicial_str)) . " al " . date("d/m/Y", strtotime($fecha_final_str));
    
    // Preparar fechas para la consulta SQL (cubriendo todo el día)
    $fecha_inicial_sql = $fecha_inicial_str . ' 00:00:00';
    $fecha_final_sql = $fecha_final_str . ' 23:59:59';
} else {
    // Escenario 1: Vista por defecto, mostrar ventas del día actual
    $hoy = date('Y-m-d');
    $fecha_inicial_str = date('Y-m-d'); // Para rellenar el formulario
    $fecha_final_str = date('Y-m-d');   // Para rellenar el formulario

    $titulo_reporte = "Reporte del Día (" . date("d/m/Y") . ")";
    
    $fecha_inicial_sql = $hoy . ' 00:00:00';
    $fecha_final_sql = $hoy . ' 23:59:59';
}

// --- CONSULTAS A LA BASE DE DATOS ---

// 1. Consulta para obtener el TOTAL DE VENTAS y el MONTO TOTAL VENDIDO
$sql_ventas = "SELECT COUNT(id_venta) AS numero_ventas, SUM(total) AS monto_total FROM ventas WHERE fecha_venta BETWEEN ? AND ?";
$stmt_ventas = $conexion->prepare($sql_ventas);
$stmt_ventas->bind_param("ss", $fecha_inicial_sql, $fecha_final_sql);
$stmt_ventas->execute();
$resultado_ventas = $stmt_ventas->get_result()->fetch_assoc();
if ($resultado_ventas) {
    $numero_ventas = $resultado_ventas['numero_ventas'] ?? 0;
    $monto_total_ventas = $resultado_ventas['monto_total'] ?? 0.00;
}
$stmt_ventas->close();

// 2. Consulta para obtener el COSTO TOTAL de los productos vendidos
// Se une detalle_venta con productos para obtener el precio de compra de cada artículo vendido
$sql_costos = "SELECT SUM(dv.cantidad * p.precio_compra) AS costo_total
               FROM detalle_venta AS dv
               JOIN productos AS p ON dv.id_producto = p.id_producto
               JOIN ventas AS v ON dv.id_venta = v.id_venta
               WHERE v.fecha_venta BETWEEN ? AND ?";
$stmt_costos = $conexion->prepare($sql_costos);
$stmt_costos->bind_param("ss", $fecha_inicial_sql, $fecha_final_sql);
$stmt_costos->execute();
$resultado_costos = $stmt_costos->get_result()->fetch_assoc();
if ($resultado_costos) {
    $costo_total_ventas = $resultado_costos['costo_total'] ?? 0.00;
}
$stmt_costos->close();

// 3. Calcular las GANANCIAS
$ganancias = $monto_total_ventas - $costo_total_ventas;

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gengaras - Reporte de Ventas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <main class="main-content">
            <header class="top-bar">
                <div class="dashboard-title"><h1>REPORTES</h1></div>
            </header>

            <div class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon">📄</span> REPORTE DE VENTAS</h2>
                </div>

                <h3><?php echo htmlspecialchars($titulo_reporte); ?></h3>
                <div class="stats-container">
                    <div class="stat-card">
                        <h4>Total de Ventas</h4>
                        <p><?php echo number_format($numero_ventas); ?></p>
                    </div>
                    <div class="stat-card">
                        <h4>Monto Total en Ventas</h4>
                        <p>$<?php echo number_format($monto_total_ventas, 2); ?></p>
                    </div>
                    <div class="stat-card">
                        <h4>Costo de Ventas</h4>
                        <p>$<?php echo number_format($costo_total_ventas, 2); ?></p>
                    </div>
                    <div class="stat-card">
                        <h4>Ganancia</h4>
                        <p class="profit">$<?php echo number_format($ganancias, 2); ?></p>
                    </div>
                </div>

                <div class="form-panel">
                    <h3><span class="icon section-icon"></span> Buscar por Periodo</h3>
                    <form method="POST" action="reporteVenta.php" class="search-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fecha_inicial">Fecha inicial</label>
                                <input type="date" id="fecha_inicial" name="fecha_inicial" value="<?php echo htmlspecialchars($fecha_inicial_str); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_final">Fecha final</label>
                                <input type="date" id="fecha_final" name="fecha_final" value="<?php echo htmlspecialchars($fecha_final_str); ?>" required>
                            </div>
                        </div>
                        <div class="report-actions">
                            <button type="submit" class="btn btn-primary">
                                <span class="icon">🔍</span> GENERAR REPORTE
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>
</body>
</html>