<?php
include("conexionbd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo_producto'];
    $nombre = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion_producto'] ?? '';
    $stock = $_POST['stock_existencias'];
    $stock_minimo = $_POST['stock_minimo'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $categoria = $_POST['categoria_producto'];
    $fecha_venc = $_POST['fecha_vencimiento'];
    $garantia = $_POST['tiempo_garantia'];
    $estado = $_POST['estado_producto'];

    $foto = $_FILES['foto_producto'];
    $nombre_foto = '';
    if ($foto['error'] === 0) {
        $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
        if (in_array($foto['type'], $permitidos) && $foto['size'] <= 3145728) {
            $nombre_foto = uniqid() . "_" . basename($foto['name']);
            $ruta_destino = "img_productos/" . $nombre_foto;
            move_uploaded_file($foto['tmp_name'], $ruta_destino);
        }
    }

    $sql = "INSERT INTO productos (
        codigo_producto,nombre_producto, descripcion, stock, stock_minimo,
        precio_compra, precio_venta, id_categoria, fecha_vencimiento,
        garantia_meses, estado, imagen
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        die("Error en prepare: " . $conexion->error);
    }

    $stmt->bind_param("ssiidddssis",$codigo, $nombre, $descripcion, $stock, $stock_minimo, $precio_compra, $precio_venta, $categoria, $fecha_venc, $garantia, $estado, $nombre_foto);

    if ($stmt->execute()) {
        echo "<script>alert('Producto agregado exitosamente'); window.location='nuevoProducto.php';</script>";
    } else {
        echo "Error al insertar producto: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
