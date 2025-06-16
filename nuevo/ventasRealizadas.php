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
                    <h1>VENTAS</h1>
                </div>
                
            </header>

            <div class="page-content nueva-venta-layout">
                <div class="venta-main-column">
                    <nav class="page-tabs venta-tabs">
                        <ul>
                            <li><a href="nuevaVenta.php"><span class="icon"></span> NUEVA VENTA</a></li>
                            <li><a href="ventasRealizadas.php" class="tab-active"><span class="icon"></span> VENTAS REALIZADAS</a></li>
                            <li><a href="buscarXFecha.php"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                            <li><a href="buscarXCodigo.php"><span class="icon"></span> BUSCAR VENTA (CODIGO)</a></li>
                        </ul>
                    </nav>
                    <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FECHA</th>
                                <th>TOTAL</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * FROM ventas";

                            $resultado = $conexion->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                // Iterar sobre cada venta encontrada
                                while($venta = $resultado->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($venta['id_venta']); ?></td>
                                        <td><?php echo date("d/m/Y h:i A", strtotime($venta['fecha_venta'])); ?></td>
                                        <td class="total-amount">$<?php echo number_format($venta['total'], 2); ?></td>
                                        <td>
                                            <a href="eliminarVenta.php?id=<?php echo $venta['id_venta']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta? Esta acción no se puede deshacer.');">🗑️</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // Si no hay ventas, mostrar un mensaje
                                echo '<tr><td colspan="5">No hay ventas realizadas registradas.</td></tr>';
                            }
                            // Cerrar la conexión
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
            </div>
        </main>
    </div>
</body>
</html>