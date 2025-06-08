<?php
include("conexionbd.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $codigo = $_POST['codigo_barras'];
    $nombre = $_POST['nombre_producto'];
    $stock = $_POST['stock_existencias'];
    $minimo = $_POST['stock_minimo'];
    $presentacion = $_POST['presentacion_producto'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $precio_mayoreo = $_POST['precio_mayoreo'];
    $descuento = $_POST['descuento_venta'];
    $marca = $_POST['marca_producto'];
    $modelo = $_POST['modelo_producto'];
    $vence = $_POST['vence_producto'];
    $fecha_venc = $_POST['fecha_vencimiento'];
    $unidad_garantia = $_POST['unidad_tiempo_garantia'];
    $tiempo_garantia = $_POST['tiempo_garantia'];
    $categoria = $_POST['categoria_producto'];
    $estado = $_POST['estado_producto'];

    
    $foto = $_FILES['foto_producto'];
    $nombre_foto = '';
    if ($foto['error'] === 0) {
        $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
        if (in_array($foto['type'], $permitidos) && $foto['size'] <= 3145728) {
            $nombre_foto = uniqid() . "_" . basename($foto['name']);
            $ruta_destino = "img_productos/" . $nombre_foto;
            move_uploaded_file($foto['tmp_name'], $ruta_destino);
        } else {
            echo "Archivo no válido o excede el tamaño permitido.";
            exit;
        }
    }

    
    $sql = "INSERT INTO productos (
                codigo_barras, nombre, stock_existencias, stock_minimo,
                presentacion, precio_compra, precio_venta, precio_mayoreo,
                descuento_venta, marca, modelo, vence, fecha_vencimiento,
                unidad_garantia, tipo_garantia, categoria, estado, foto
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssiiddddddssssssss",
        $codigo, $nombre, $stock, $minimo, $presentacion,
        $precio_compra, $precio_venta, $precio_mayoreo, $descuento,
        $marca, $modelo, $vence, $fecha_venc, $unidad_garantia,
        $tiempo_garantia, $categoria, $estado, $nombre_foto
    );

    if ($stmt->execute()) {
        echo "<script>alert('Producto agregado exitosamente'); window.location='nuevoProducto.php';</script>";
    } else {
        echo "Error al insertar producto: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
