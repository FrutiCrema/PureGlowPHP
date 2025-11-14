<?php
require_once "../database/db.php";

$mysqli = db::connect();


$idUser = $_SESSION["AUTH"]["user_id"];

// Crear la vista fuera del bloque de procedimiento
$sqlCreateView = "CREATE OR REPLACE VIEW `V_ProductosAutorizados` AS
    SELECT `p`.`producto_name`, `p`.`producto_price`, `p`.`producto_idUser`, `c`.`category_name`, (
        SELECT `i`.`imagen_content`
        FROM `tb_image` `i`
        WHERE `i`.`imagen_idProducto` = `p`.`producto_id`
        LIMIT 1
    ) AS Contenido_imagen
    FROM `tb_product` `p`
    JOIN `tb_categoryproduct` `cp` ON `cp`.`categoryProduct_idProduct` = `p`.`producto_id`
    JOIN `tb_category` `c` ON `c`.`category_id` = `cp`.`categoryProduct_idCategory`
    WHERE `p`.`producto_idAdmin` = $idUser";

// Ejecutar la consulta para crear la vista
if ($mysqli->query($sqlCreateView) === TRUE) {

    // Consulta SQL para obtener los datos de la vista
    $sqlSelectView = "SELECT `producto_name`, `producto_price`, `producto_idUser`, `category_name`, `Contenido_imagen`
    FROM `V_ProductosAutorizados`";

} else {
    // echo "Error al crear la vista: " . $conn->error;
}


// Ejecutar la consulta para obtener los datos de la vista
$result = $mysqli->query($sqlSelectView);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Iterar sobre los resultados y generar el HTML para cada producto
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
            echo '<div class="overlay">';
            echo '<a href="front/pages/DetalleProducto.html" class="product-thumb">';
            echo '<img src="' . $row["Contenido_imagen"] . '" alt="" />';
            echo '</a>';
            echo '</div>';
            echo '<div class="product-info">';
            echo '<span>' . $row["category_name"] . '</span>';
            echo '<a href="front/pages/DetalleProducto.html">' . $row["producto_name"] . '</a>';
            echo '<h4>$' . $row["producto_price"] . '</h4>';
            echo '</div>';
        echo '</div>';
    }
} else {
    echo "No se encontraron productos.";
}


$sqlDeleteView = "DROP VIEW V_ProductosAutorizados";

$resultado = $mysqli->query($sqlDeleteView);

?>


