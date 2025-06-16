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
                    <h1>ADMINISTRACION</h1>
                </div>
                
            </header>
            <section class="page-content">
                <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminado'): ?>
    <div class="alert success">✅ Categoría eliminada correctamente.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 'usada'): ?>
    <div class="alert error">⚠️ No se puede eliminar: Esta categoría tiene productos asociados.</div>
<?php endif; ?>

                <nav class="page-tabs">
                    <ul>
                        <li><a href="nuevaCategoria.php"><span class="icon"></span> NUEVA CATEGORIA</a></li>
                        <li><a href="listaCategorias.php" class="tab-active"><span class="icon"></span> LISTA DE CATEGORIAS</a></li>
                    </ul>
                </nav>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>UBICACION</th>
                                <th>ESTADO</th>
                                <th>ACTUALIZAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id_categoria, nombre_categoria, ubicacion, estado FROM categorias ORDER BY nombre_categoria ASC";
                            $resultado = $conexion->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                while($categoria = $resultado->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($categoria['id_categoria']); ?></td>
                                        <td><?php echo htmlspecialchars($categoria['nombre_categoria']); ?></td>
                                        <td><?php echo htmlspecialchars($categoria['ubicacion']); ?></td>
                                        <td>
                                            <?php if ($categoria['estado'] == 'Habilitada'): ?>
                                                <span class="status status-active">Habilitada</span>
                                            <?php else: ?>
                                                <span class="status status-inactive">Deshabilitada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="actualizarCategoria.php?id=<?php echo $categoria['id_categoria']; ?>" class="action-icon action-edit" title="Actualizar"><span class="icon">✏️</span></a>
                                        </td>
                                        <td>
                                            <a href="eliminarCategoria.php?id=<?php echo $categoria['id_categoria']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta categoría?');"><span class="icon">🗑️</span></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="5">No hay categorías registradas.</td></tr>';
                            }
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>