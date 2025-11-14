<?php

require_once "../database/db.php";

$mysqli = db::connect();

// Consulta SQL para obtener los datos de la vista
$sql = "SELECT * FROM vista_productos_mejor_calificados  LIMIT 8";
$result = $mysqli->query($sql);

// session_start(); // Asegúrate de iniciar la sesión

$rol = $_SESSION["AUTH"]["user_rol"];

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Iterar sobre los resultados y generar el HTML para cada producto
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<div class="overlay">';
        echo '<a href="DetalleProducto.php" class="product-thumb">';
        echo '<img src="' . $row["Imagen"] . '" alt="" />';
        echo '</a>';
        echo '</div>';
        echo '<div class="product-info">';
        echo '<span>' . $row["category_name"] . '</span>';
        echo '<p>' . $row["producto_name"] . '</p>';
        echo '<h4>$' . $row["producto_price"] . '</h4>';
        echo '</div>';
        echo '<ul class="icons">';
        echo '<li><a href="DetalleProducto.php"><i  data-product-id="' . $row["producto_id"] . '"  class="bx bxs-show"></i></a></li>';

        // Condición para habilitar o deshabilitar el ícono del carrito
        if ($rol == 1) {
            echo '<li><a class="carrito-btn"><i data-product-id="' . $row["producto_id"] . '" class="bx bx-cart"></i></a></li>';
        } else {
            echo '<li><a class="carrito-btn" style="pointer-events: none; opacity: 0.5;"><i data-product-id="' . $row["producto_id"] . '" class="bx bx-cart"></i></a></li>';
        }

        echo '</ul>';
        echo '</div>';
    }
} else {
    echo "No se encontraron productos.";
}
?>

<!-- <script src="/PureGlow/back/src/js/AgregarCarrito.js"></script> -->
<script src="/PureGlow/back/src/js/DetalleProducto.js"></script>
