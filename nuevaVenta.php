<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<?php
session_start();
include 'conexionbd.php';
include 'sidebar.php';


$productos = [];
$query = "SELECT id_producto, nombre_producto, stock, precio_venta FROM productos WHERE stock > 0";
$resultado = $conexion->query($query);
while ($row = $resultado->fetch_assoc()) {
    $productos[] = $row;
}
?>

<main class="main-content">
    <header class="top-bar">
        <div class="dashboard-title">
            <h1>VENTAS</h1>
        </div>
    </header>

    <div class="page-content nueva-venta-layout">
        <div class="venta-main-column">
            <div class="page-header">
                <h2><span class="icon section-icon"></span> NUEVA VENTA</h2>
                <p>En el módulo VENTAS podrá realizar ventas de productos.</p>
            </div>

            <nav class="page-tabs venta-tabs">
                <ul>
                    <li><a href="nuevVenta.php" class="tab-active"><span class="icon"></span> NUEVA VENTA</a></li>
                    <li><a href="ventasRealizadas.php"><span class="icon"></span> VENTAS REALIZADAS</a></li>
                    <li><a href="buscarXFecha.php"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                    <li><a href="buscarXCodigo.php"><span class="icon"></span> BUSCAR VENTA (CODIGO)</a></li>
                </ul>
            </nav>

            <section class="nueva-venta-form">
  <h3>Datos de Venta</h3>
  <form id="formVenta" method="POST" action="registrarVenta.php" style="max-width: 600px; margin: 0 auto;">

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">

      <div style="flex: 1 1 48%;">
        <label for="fecha_venta" style="font-weight: 600; display: block; margin-bottom: 6px;">Fecha de Venta:</label>
        <input type="date" id="fecha_venta" name="fecha_venta" required
          style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
      </div>

      <div style="flex: 1 1 48%;">
        <label for="tipo_pago" style="font-weight: 600; display: block; margin-bottom: 6px;">Tipo de Pago:</label>
        <select id="tipo_pago" name="tipo_pago" required
          style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
          <option value="Contado">Contado</option>
          <option value="Credito">Crédito</option>
        </select>
      </div>

      <div style="flex: 1 1 100%;">
        <label for="producto" style="font-weight: 600; display: block; margin-bottom: 6px;">Producto:</label>
        <select name="producto" id="producto" required onchange="actualizarStockPrecio()"
          style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
          <option value="">-- Selecciona un producto --</option>
          <?php foreach ($productos as $prod): ?>
            <option value="<?= $prod['id_producto'] ?>"
              data-stock="<?= $prod['stock'] ?>"
              data-precio="<?= $prod['precio_venta'] ?>">
              <?= $prod['nombre_producto'] ?> (<?= $prod['stock'] ?> disponibles)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div style="flex: 1 1 48%;">
        <label for="cantidad" style="font-weight: 600; display: block; margin-bottom: 6px;">Cantidad a vender:</label>
        <input type="number" id="cantidad" name="cantidad" min="1" required
          style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
        <small id="stockDisponible" style="color: #555; font-style: italic;"></small>
      </div>

      <div style="flex: 1 1 48%;">
        <label for="descuento_venta" style="font-weight: 600; display: block; margin-bottom: 6px;">Descuento de venta (%):</label>
        <input type="number" id="descuento_venta" name="descuento_venta" min="0" max="100" value="0"
          style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
      </div>

      <div style="flex: 1 1 48%;">
        <label for="total_pagado" style="font-weight: 600; display: block; margin-bottom: 6px;">Total pagado por cliente:</label>
        <input type="number" id="total_pagado" name="total_pagado" step="0.01" min="0" value="0.00" required
          style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem;">
      </div>

    </div>
            <h4 style="margin-top: 30px; font-weight: 700; border-bottom: 2px solid #007bff; padding-bottom: 8px;">Resumen</h4>
<div style="background: #f9f9f9; border-radius: 8px; padding: 15px 20px; max-width: 600px; margin: 10px auto 0 auto; box-shadow: 0 0 8px rgba(0,0,0,0.05); font-size: 1rem; color: #333;">
  <p><strong>Subtotal:</strong> + $<span id="subtotal">0.00</span> USD</p>
  <p><strong>IVA (15%):</strong> + $<span id="iva">0.00</span> USD</p>
  <p><strong>Descuento:</strong> - $<span id="descuento">0.00</span> USD</p>
  <p style="font-size: 1.2rem; margin-top: 10px;"><strong>Total:</strong> $<span id="total">0.00</span> USD</p>
  <p><strong>Cambio devuelto al cliente:</strong> $<span id="cambio">0.00</span> USD</p>
</div>

    <button type="submit"
      style="margin-top: 20px; padding: 12px 25px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; transition: background-color 0.3s ease;">
      Finalizar Venta
    </button>

  </form>
</section>

        </div>
    </div>
</main>

<script>
function actualizarStockPrecio() {
    const select = document.getElementById('producto');
    const selected = select.options[select.selectedIndex];
    const stock = selected.getAttribute('data-stock');
    const precio = parseFloat(selected.getAttribute('data-precio')) || 0;

    document.getElementById('stockDisponible').innerText = `Stock disponible: ${stock}`;
    calcularResumen(precio);
}

document.getElementById('formVenta').addEventListener('input', function () {
    const select = document.getElementById('producto');
    const selected = select.options[select.selectedIndex];
    const precio = parseFloat(selected.getAttribute('data-precio')) || 0;
    calcularResumen(precio);
});

function calcularResumen(precio) {
    const cantidad = parseInt(document.getElementById('cantidad').value) || 0;
    const descuento = parseFloat(document.getElementById('descuento_venta').value) || 0;
    const totalPagado = parseFloat(document.getElementById('total_pagado').value) || 0;

    const subtotal = precio * cantidad;
    const iva = subtotal * 0.15;
    const descuentoValor = subtotal * (descuento / 100);
    const total = subtotal + iva - descuentoValor;
    const cambio = totalPagado - total;

    document.getElementById('subtotal').textContent = subtotal.toFixed(2);
    document.getElementById('iva').textContent = iva.toFixed(2);
    document.getElementById('descuento').textContent = descuentoValor.toFixed(2);
    document.getElementById('total').textContent = total.toFixed(2);
    document.getElementById('cambio').textContent = cambio >= 0 ? cambio.toFixed(2) : "0.00";
}
</script>

</body>
</html>
