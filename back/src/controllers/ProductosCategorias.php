<?php
require_once "../database/db.php";
require_once "../models/Producto.php";

$mysqli = db::connect();


$idUser = $_SESSION["AUTH"]["user_id"];
$idCategory = $_SESSION["INFO_CATEGORIA"]["category_id"];


$productos = Product::ProductosMismaCategoria($mysqli, $idCategory);

// Verificar si se obtuvieron resultados
if ($productos->num_rows > 0) {
    // Iterar sobre los resultados y generar el HTML para cada producto
    while ($row = $productos->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<div class="overlay">';
        echo '<a href="DetalleProducto.php" class="product-thumb">';
        echo '<img src="' . $row["imagen_content"] . '" alt="" />';
        echo '</a>';
        echo '</div>';
        echo '<div class="product-info">';
        echo '<span>' . $row["category_name"] . '</span>';
        echo '<p>' . $row["producto_name"] . '</p>';
        echo '<h4>$' . $row["producto_price"] . '</h4>';
        echo '</div>';
        echo '<ul class="icons">';
        echo '<li><a href="#"><i  data-product-id="' . $row["producto_id"] . '"  class="bx bxs-show"></i></a></li>';

        // Condición para habilitar o deshabilitar el ícono del carrito
        if ($rol == 1) {
            echo '<li><a class="carrito-btn"><i data-product-id="' . $row["producto_id"] . '" class="bx bx-cart"></i></a></li>';
        } else {
            echo '<li><a class="carrito-btn" style="pointer-events: none; opacity: 0.5;"><i class="bx bx-cart"></i></a></li>';
        }

        echo '</ul>';
        echo '</div>';
    }
} else {
    echo "No se encontraron productos.";
}


// $sqlDeleteView = "DROP VIEW V_ProductosAutorizados";

// $resultado = $mysqli->query($sqlDeleteView);

?>


