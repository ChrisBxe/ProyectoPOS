<?php
session_start();
require 'auth.php';

requiereLogin();
requiereRol(['administrador']);

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
                    <h1>ADMINISTRACION</h1>
                </div>
                
            </header>
            <section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon"></span> NUEVA CATEGORIA</h2> <p>En el modulo CATEGORIA usted podra registrar las categorias que serviran para agregar productos y tambien podra ver los productos que pertenecen a una categoria determinada. Ademas de lo antes mencionado, puede actualizar los datos de las categorias, realizar busquedas de categorias o eliminarlas si asi lo desea.</p>
                </div>

                <nav class="page-tabs">
                    <ul>
                        <li><a href="nuevaCategoria.php" class="tab-active"><span class="icon"></span> NUEVA CATEGORIA</a></li>
                        <li><a href="listaCategorias.php"><span class="icon"></span> LISTA DE CATEGORIAS</a></li>
                    </ul>
                </nav>

                <div class="form-panel">
                    <h3><span class="icon section-icon"></span> Informacion de la categoria</h3>
                    <form action="registrarCategoria.php" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre_categoria">Nombre de la categoria</label>
                                <div class="input-with-icon">
                                    <input type="text" id="nombre_categoria" name="nombre_categoria" placeholder="Ej: Bebidas">
                                    <span class="icon-field"></span> </div>
                            </div>
                            <div class="form-group">
                                <label for="ubicacion_categoria">Pasillo o ubicacion de la categoria</label>
                                <div class="input-with-icon">
                                    <input type="text" id="ubicacion_categoria" name="ubicacion_categoria" placeholder="Ej: Pasillo 2, Estante A">
                                    <span class="icon-field"></span> </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"> <label for="estado_categoria">Estado de la categoria</label>
                                <select id="estado_categoria" name="estado_categoria">
                                    <option value="habilitada" selected>Habilitada</option>
                                    <option value="deshabilitada">Deshabilitada</option>
                                </select>
                            </div>
                            <div class="form-group">
                                </div>
                        </div>
                        <div class="form-actions">
                            <button type="reset" class="btn btn-secondary"><span class="icon"></span> LIMPIAR</button>
                            <button type="submit" class="btn btn-primary"><span class="icon"></span> GUARDAR</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>
</html>