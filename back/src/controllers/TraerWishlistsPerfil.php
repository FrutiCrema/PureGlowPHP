<?php
require_once "../database/db.php";
require_once "../models/Producto.php";

$mysqli = db::connect();


$idUser = $_SESSION["AUTH"]["user_id"];
$idProducto = $_SESSION["INFO_PRODUCT"]['producto_id'];


$productos = Product::TraerWishlistPerfil($mysqli, $idUser);

// Verificar si se obtuvieron resultados
if ($productos->num_rows > 0) {
    // Iterar sobre los resultados y generar el HTML para cada producto

   
    while ($row = $productos->fetch_assoc()) {

        
        echo '<div class="wishlist-item">';

            echo '<span class="wishlist-name">' . $row["lista_name"] . '</span>';
            echo ' <div class="wishlist-options">';
            echo '<button class="wishlist-edit" data-product-id="' . $row["lista_id"] . '" onclick="openEditModal(' . $row["lista_id"] . ')">Editar</button>';
            echo '<button class="wishlist-delete" data-product-id="' . $row["lista_id"] . '" onclick="EliminarWishlist(' . $row["lista_id"] . ')">Eliminar</button>';
            echo '</div>';
            echo '</div>';
    }
   
} else {
    echo "No se encontraron productos.";
}


// $sqlDeleteView = "DROP VIEW V_ProductosAutorizados";

// $resultado = $mysqli->query($sqlDeleteView);

?>


