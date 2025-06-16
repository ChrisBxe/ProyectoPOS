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
                <div class="menu-toggle">
                    <span class="icon"></span>
                </div>
                <div class="dashboard-title">
                    <h1>ADMINISTRACION</h1>
                </div>
                <div class="user-actions">
                    <span class="icon"></span>
                    <span class="icon"></span>
                    <span class="icon"></span>
                </div>
            </header>
            <section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon"></span> NUEVO USUARIO</h2>
                    <p>En el modulo USUARIO podra registrar nuevos usuarios en el sistema ya sea un administrador o un cajero, tambien podra ver la lista de usuarios registrados, buscar usuarios en el sistema, actualizar datos de otros usuarios y los suyos.</p>
                </div>

                <nav class="page-tabs">
                    <ul>
                        <li><a href="nuevoUsuario.php" class="tab-active"><span class="icon"></span> NUEVO USUARIO</a></li>
                        <li><a href="listaUsuarios.php"><span class="icon"></span> LISTA DE USUARIOS</a></li>
                    </ul>
                </nav>

                <form action="agregarUsuario.php" method="post">
                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Informacion personal</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo de documento</label>
                                <div class="input-with-icon">
                                    <select id="tipo_documento" name="tipo_documento">
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        <option value="dni">DNI</option>
                                        <option value="pasaporte">Pasaporte</option>
                                        <option value="cedula">Cedula</option>
                                    </select>
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="numero_documento">Numero de documento</label>
                                <div class="input-with-icon">
                                    <input type="text" id="numero_documento" name="numero_documento" placeholder="Numero de documento">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                 <div class="input-with-icon">
                                    <select id="cargo" name="cargo">
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        <option value="administrador">Administrador</option>
                                        <option value="cajero">Cajero</option>
                                        <option value="vendedor">Vendedor</option>
                                    </select>
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <div class="input-with-icon">
                                    <input type="text" id="nombres" name="nombres" placeholder="Nombres completos">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <div class="input-with-icon">
                                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos completos">
                                     <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="text" id="telefono" name="telefono" placeholder="Numero de telefono">
                            </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <div class="form-row">
                            <div class="form-group form-group-compound"> <h3><span class="icon section-icon"></span> Genero</h3>
                                <div class="radio-group">
                                    <label class="radio-label"><input type="radio" name="genero" value="masculino" checked> Masculino</label>
                                    <label class="radio-label"><input type="radio" name="genero" value="femenino"> Femenino</label>
                                </div>
                            </div>
                            <div class="form-group form-group-compound"> <h3><span class="icon section-icon"><y_bin_226></span> Configuracion de lector de codigo de barras</h3>
                                <div class="radio-group-vertical">
                                    <div class="radio-group">
                                        <label class="radio-label"><input type="radio" name="usar_lector" value="si" checked> Usar lector</label>
                                        <label class="radio-label"><input type="radio" name="usar_lector" value="no"> No usar lector</label>
                                    </div>
                                    <div class="radio-group">
                                        <label class="radio-label"><input type="radio" name="tipo_codigo" value="barras" checked> Codigo barras</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-panel">
                        <h3><span class="icon section-icon"></span> Informacion de la cuenta</h3>
                         <div class="form-row">
                            <div class="form-group">
                                <label for="nombre_usuario">Nombre de usuario</label>
                                <div class="input-with-icon">
                                    <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de usuario">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contrasena">Contrasena</label>
                                 <div class="input-with-icon">
                                    <input type="password" id="contrasena" name="contrasena" placeholder="Contrasena">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repetir_contrasena">Repetir contrasena</label>
                                <div class="input-with-icon">
                                    <input type="password" id="repetir_contrasena" name="repetir_contrasena" placeholder="Repetir contrasena">
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="estado">Estado de la cuenta</label>
                                <div class="input-with-icon">
                                    <select id="estado" name="estado">
                                        <option value="1" selected>1 - Activa</option>
                                        <option value="0">0 - Inactiva</option>
                                    </select>
                                    <span class="icon-field"></span>
                                </div>
                            </div>
                             <div class="form-group">
                                </div>
                        </div>
                    </div>

                    <div class="form-actions-main">
                        <button type="reset" class="btn btn-secondary"><span class="icon"></span> LIMPIAR</button>
                        <button type="submit" class="btn btn-primary"><span class="icon"></span> GUARDAR</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>