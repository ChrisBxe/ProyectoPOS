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
        <div class="container">
        <?php include('sidebar.php'); ?>

        <main class="main-content">
            
            <header class="top-bar">

                <div class="dashboard-title">
                    <h1>VENTAS</h1>
                </div>
                <div class="user-actions">
                    <span class="icon">POWER</span>
                </div>
            </header>

            <div class="page-content nueva-venta-layout">
                <div class="venta-main-column">
                    <div class="page-header">
                        <h2><span class="icon section-icon"></span> NUEVA VENTA</h2>
                        <p>En el modulo VENTAS podra realizar ventas de productos, puede usar lector de codigo de barras o hacerlo de forma manual digitando el codigo del producto (debe de configurar estas opciones en ajustes de su cuenta). Tambien puede ver las ventas realizadas y buscar ventas en el sistema.</p>
                    </div>

                    <nav class="page-tabs venta-tabs">
                        <ul>
                            <li><a href="nuevVenta.php" class="tab-active"><span class="icon"></span> NUEVA VENTA</a></li>
                            <li><a href="ventasRealizadas.php"><span class="icon"></span> VENTAS REALIZADAS</a></li>
                            <li><a href="ventasPendientes.php"><span class="icon"></span> VENTAS PENDIENTES</a></li>
                            <li><a href="buscarXFecha.php"><span class="icon"></span> BUSCAR VENTA (FECHA)</a></li>
                            <li><a href="buscarXCodigo.php"><span class="icon"></span> BUSCAR VENTA (CODIGO)</a></li>
                        </ul>
                    </nav>

                    <div class="product-search-area">
                        <label for="codigo_producto_venta" class="buscar-producto-label"><span class="icon"></span> BUSCAR PRODUCTO</label>
                        <input type="text" id="codigo_producto_venta" name="codigo_producto_venta" placeholder="Codigo de producto">
                        <button type="submit" class="btn btn-primary btn-generate-report">
                            <span class="icon">🔍</span> BUSCAR
                        </button>
                    </div>

                    <div class="products-table-container">
                        <table class="data-table products-sale-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo de barra</th>
                                    <th>Producto</th>
                                    <th>Cant.</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                    <th>Actualizar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="no-products-message">No hay productos agregados</td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                    <div class="venta-actions-footer">
                        <button type="button" class="btn btn-danger"><span class="icon"></span> CANCELAR VENTA</button>
                        <button type="button" class="btn btn-success"><span class="icon"></span> PROCESAR VENTA</button>
                    </div>
                </div>

                <aside class="venta-datos-sidebar">
                    <h3>DATOS DE LA VENTA</h3>
                    <form id="datos-venta-form">
                        <div class="form-group-sidebar">
                            <label for="venta_fecha">Fecha</label>
                            <input type="text" id="venta_fecha" name="venta_fecha" value="02/06/2025" disabled>
                        </div>
                        <div class="form-group-sidebar">
                            <label for="venta_caja">Caja</label>
                            <input type="text" id="venta_caja" name="venta_caja" value="Caja #10000 - ADMINISTRADOR CAFE" disabled>
                        </div>
                        <div class="form-group-sidebar">
                            <label for="venta_cliente">Cliente</label>
                            <div class="input-with-icon-right">
                                <input type="text" id="venta_cliente" name="venta_cliente" value="Publico General">
                                <button type="button" class="icon-button"><span class="icon"></span></button>
                            </div>
                        </div>
                        <div class="form-group-sidebar">
                            <label>Tipo de pago</label>
                            <div class="radio-group">
                                <label class="radio-label"><input type="radio" name="tipo_pago" value="contado" checked> Contado</label>
                                <label class="radio-label"><input type="radio" name="tipo_pago" value="credito"> Credito</label>
                            </div>
                        </div>
                         <div class="form-group-sidebar">
                            <label for="venta_descuento_porcentaje">Descuento de venta (%)</label>
                            <div class="input-with-icon-right">
                                <input type="number" id="venta_descuento_porcentaje" name="venta_descuento_porcentaje" value="0">
                                <button type="button" class="icon-button"><span class="icon">%</span></button>
                            </div>
                        </div>
                        <div class="form-group-sidebar">
                            <label for="venta_total_pagado">Total pagado por cliente</label>
                             <div class="input-with-icon-right">
                                <input type="text" id="venta_total_pagado" name="venta_total_pagado" value="0.00">
                                <button type="button" class="icon-button"><span class="icon"></span></button>
                            </div>
                        </div>
                        <div class="form-group-sidebar">
                            <label for="venta_cambio">Cambio devuelto a cliente</label>
                            <input type="text" id="venta_cambio" name="venta_cambio" value="0.00" disabled>
                        </div>

                        <hr class="sidebar-divider">

                        <div class="venta-summary">
                            <div class="summary-item">
                                <span>Subtotal</span>
                                <span id="venta_subtotal" class="summary-value">+ $0.00 USD</span>
                            </div>
                            <div class="summary-item">
                                <span>IVA (15%)</span>
                                <span id="venta_iva" class="summary-value">+ $0.00 USD</span>
                            </div>
                            <div class="summary-item">
                                <span>Descuento</span>
                                <span id="venta_descuento" class="summary-value summary-discount">- $0.00 USD</span>
                            </div>
                            <div class="summary-item summary-total">
                                <span>Total</span>
                                <span id="venta_total" class="summary-value total-value">$0.00 USD</span>
                            </div>
				<button type="button" onclick="registrarVenta()">Finalizar Venta</button>
                        </div>
                    </form>
                </aside>
            </div>
        </main>
    </div>
<script>
    let productosVenta = [
        { id_producto: 1, cantidad: 2, precio_unitario: 10.00 },
        { id_producto: 2, cantidad: 1, precio_unitario: 20.00 }
    ];

    function calcularTotales() {
        let subtotal = 0;
        productosVenta.forEach(p => {
            subtotal += p.cantidad * p.precio_unitario;
        });

        let iva = subtotal * 0.15;

        const descuentoInput = document.getElementById('venta_descuento_porcentaje');
        let porcentajeDescuento = parseFloat(descuentoInput.value) || 0;
        let descuento = ((subtotal + iva) * porcentajeDescuento) / 100;

        let total = (subtotal + iva) - descuento;

        const pagadoInput = document.getElementById('venta_total_pagado');
        let pagado = parseFloat(pagadoInput.value) || 0;
        let cambio = pagado - total;

        // ✅ Usamos IDs específicos para actualizar los valores
        document.getElementById("venta_subtotal").textContent = "+ $" + subtotal.toFixed(2) + " USD";
        document.getElementById("venta_iva").textContent = "+ $" + iva.toFixed(2) + " USD";
        document.getElementById("venta_descuento").textContent = "- $" + descuento.toFixed(2) + " USD";
        document.getElementById("venta_total").textContent = "$" + total.toFixed(2) + " USD";
        document.getElementById("venta_cambio").value = cambio >= 0 ? cambio.toFixed(2) : "0.00";
    }

    document.getElementById('venta_descuento_porcentaje').addEventListener('input', calcularTotales);
    document.getElementById('venta_total_pagado').addEventListener('input', calcularTotales);

    window.onload = calcularTotales;

    function registrarVenta() {
        const form = document.getElementById('datos-venta-form');
        const formData = new FormData(form);
        formData.append('productos', JSON.stringify(productosVenta));

        fetch('registrarVenta.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Venta registrada correctamente");
                location.reload();
            } else {
                alert("Error: " + data.error);
            }
        });
    }
</script>


    <script>
document.getElementById('codigo_producto_venta').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        let codigo = this.value.trim();

        if (codigo === '') {
            alert("Ingrese un código de producto");
            return;
        }

        fetch('buscarProducto.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'codigo=' + encodeURIComponent(codigo)
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                
                console.log("Producto encontrado:", data);
                
            }
        });
    }
});
</script>
</body>

</body>
</html>