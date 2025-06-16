<?php

function requiereLogin() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }
}

function requiereRol(array $rolesPermitidos) {
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $rolesPermitidos)) {
        echo "<p style='color:red;'>Acceso denegado. No tienes permiso para ver esta sección.</p>";
        exit;
    }
}
