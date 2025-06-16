<?php
session_start();
require 'auth.php';

requiereLogin();
requiereRol(['administrador']);

?>
<?php
include 'conexionbd.php';

$ordenar = $_GET['ordenar_reporte'] ?? 'nombre_asc';

switch ($ordenar) {
    case 'nombre_asc':
        $orderBy = "nombre_producto ASC";
        break;
    case 'nombre_desc':
        $orderBy = "nombre_producto DESC";
        break;
    case 'stock_asc':
        $orderBy = "stock ASC";
        break;
    case 'stock_desc':
        $orderBy = "stock DESC";
        break;
    default:
        $orderBy = "nombre_producto ASC";
}

$sql = "SELECT id_producto, nombre_producto, descripcion, stock, precio_venta FROM productos ORDER BY $orderBy";
$result = $conexion->query($sql);
if ($result === false) {
    die("Error en la consulta: " . $conexion->error);
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

    include 'sidebar.php';
?>

        <main class="main-content">
            <header class="top-bar">
                <div class="dashboard-title">
                    <h1>REPORTES</h1> </div>
                
            </header>

            <section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon"></span> REPORTES DE INVENTARIO</h2> <p>En el modulo REPORTES podra ver el reporte de inventario.</p>
                </div>

                <div class="report-generator-panel">
                    <h3>Generar reporte de inventario personalizado</h3>
                    <div class="form-group report-filter-group">
                        <form method="GET" action="reporteInventario.php">
                            <label for="ordenar_reporte">Ordenar por</label>
                            <select id="ordenar_reporte" name="ordenar_reporte">
                                <option value="nombre_asc" <?php if (($ordenar ?? '') == 'nombre_asc') echo 'selected'; ?>>Nombre (ascendente)</option>
                                <option value="nombre_desc" <?php if (($ordenar ?? '') == 'nombre_desc') echo 'selected'; ?>>Nombre (descendente)</option>
                                <option value="stock_asc" <?php if (($ordenar ?? '') == 'stock_asc') echo 'selected'; ?>>Stock (ascendente)</option>
                                <option value="stock_desc" <?php if (($ordenar ?? '') == 'stock_desc') echo 'selected'; ?>>Stock (descendente)</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-generate-report">
                                GENERAR REPORTE
                        </button>
                    </div>
                </div>
            </section>
            <table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Producto</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id_producto']); ?></td>
            <td><?php echo htmlspecialchars($row['nombre_producto']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($row['stock']); ?></td>
            <td><?php echo htmlspecialchars(number_format($row['precio_venta'], 2)); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

            </main>
    </div>
</body>
</html>