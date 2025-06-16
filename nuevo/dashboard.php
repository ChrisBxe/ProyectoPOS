
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
                    <h1>DASHBOARD</h1>
                    <p>Bienvenid@ </p>
                </div>
                
            </header>
            <section class="dashboard-widgets">
                <div class="widget-row">
                    <a href="listaCategorias.php" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>CATEGORIAS</h3>
                    </a>
                    <a href="listaUsuarios.php" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>USUARIOS</h3>
                    </a>
                    <a href="ProductosAlmacen.php" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>PRODUCTOS</h3>
                    </a>

                    <a href="ventasRealizadas.php" class="widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>VENTAS</h3>
                    </a>
                </div>
                <div class="widget-row">
                    <a href="reporteVenta.php" class="widget large-widget">
                        <div class="widget-icon"><span class="icon-large"></span></div>
                        <h3>REPORTES</h3>
                    </a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>