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
                </div>
                <div class="dashboard-title">
                    <h1>REPORTES</h1>
                </div>
                
            </header>
<section class="page-content">
                <div class="page-header">
                    <h2><span class="icon section-icon">💲</span> REPORTES DE VENTAS</h2>
                    <p>En el modulo REPORTES podra ver, generar el reportes de ventas.</p>
                </div>
                <div class="stats-panel">
                    <h3>Estadisticas de ventas de hoy *dia que se realiza*</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">VENTAS REALIZADAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">TOTAL EN VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">COSTO DE VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">GANANCIAS</span>
                            <span class="stat-value stat-profit">**</span>
                        </div>
                    </div>
                </div>
                <div class="report-generator-panel">
                    <h3>Generar reporte personalizado</h3>
                    <form action="#" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fecha_inicial">Fecha inicial (dia/mes/año)</label>
                                <div class="input-with-icon">
                                    <input type="text" id="fecha_inicial" name="fecha_inicial" placeholder="dd/mm/aaaa">
                                    <span class="icon-field">📅</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fecha_final">Fecha final (dia/mes/año)</label>
                                <div class="input-with-icon">
                                    <input type="text" id="fecha_final" name="fecha_final" placeholder="dd/mm/aaaa">
                                    <span class="icon-field">📅</span>
                                </div>
                            </div>
                        </div>
                        <div class="report-actions">
                            <button type="submit" class="btn btn-primary btn-generate-report">
                                <span class="icon">⚙️</span> GENERAR REPORTE
                            </button>
                        </div>
                                        <div class="stats-panel">
                    <h3>Ventas del dia *dia que se escoge* al *segindo dia que se escoge*</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">VENTAS REALIZADAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">TOTAL EN VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">COSTO DE VENTAS</span>
                            <span class="stat-value">**</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">GANANCIAS</span>
                            <span class="stat-value stat-profit">**</span>
                        </div>
                    </div>
                </div>
                    </form>
                </div>
            </section>
            </main>
    </div>
</body>
</html>