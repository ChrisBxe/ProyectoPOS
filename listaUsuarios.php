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
                <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado'): ?>
    <div class="alert success">✅ Usuario eliminado correctamente.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>
    <div class="alert error">❌ Usuario no encontrado.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'db'): ?>
    <div class="alert error">⚠️ Error al eliminar el usuario en la base de datos.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'noid'): ?>
    <div class="alert error">⚠️ No se proporcionó un ID de usuario válido.</div>
<?php endif; ?>

                <nav class="page-tabs">
                    <ul>
                        <li><a href="nuevoUsuario.php"><span class="icon"></span> NUEVO USUARIO</a></li>
                        <li><a href="listaUsuarios.php" class="tab-active"><span class="icon"></span> LISTA DE USUARIOS</a></li>
                    </ul>
                </nav>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DOCUMENTO</th>
                                <th>CARGO</th>
                                <th>NOMBRE</th>
                                <th>USUARIO</th>
                                <th>TELEFONO</th>
                                <th>ACTUALIZAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT id_usuario, tipo_documento, numero_documento, cargo, nombres, apellidos, nombre_usuario, telefono 
                                    FROM usuarios 
                                    ORDER BY nombres ASC";
                            $resultado = $conexion->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                
                                while($usuario = $resultado->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                                        <td><?php echo htmlspecialchars(strtoupper($usuario['tipo_documento']) . ' - ' . $usuario['numero_documento']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['cargo']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                                        <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                                        <td>
                                            <a href="actualizarUsuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="action-icon action-edit" title="Actualizar"><span class="icon">✏️</span></a>
                                        </td>
                                        <td>
                                            <a href="eliminarUsuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="action-icon action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?');"><span class="icon">🗑️</span></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                
                                echo '<tr><td colspan="7">No hay usuarios registrados.</td></tr>';
                            }
                           
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
            </section>
        </main>
    </div>
</body>
</html>