<?php
require_once "../database/db.php";

$mysqli = db::connect();

$rol = $_SESSION["AUTH"]["user_rol"];

// Pagination
$limit = 8; // Número de productos por página
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página actual
$start = ($page - 1) * $limit; // Calcula el inicio de los resultados




// Crear la vista fuera del bloque de procedimiento
$sqlCreateView = "CREATE OR REPLACE VIEW `V_Productos` AS
    SELECT `p`.`producto_id`,`p`.`producto_name`, `p`.`producto_price`, `p`.`producto_idUser`, `c`.`category_name`, (
        SELECT `i`.`imagen_content`
        FROM `tb_image` `i`
        WHERE `i`.`imagen_idProducto` = `p`.`producto_id`
        LIMIT 1
    ) AS Contenido_imagen
    FROM `tb_product` `p`
    JOIN `tb_categoryproduct` `cp` ON `cp`.`categoryProduct_idProduct` = `p`.`producto_id`
    JOIN `tb_category` `c` ON `c`.`category_id` = `cp`.`categoryProduct_idCategory`
        WHERE `p`.`producto_isApproved` = 1";



// Ejecutar la consulta para crear la vista
if ($mysqli->query($sqlCreateView) === TRUE) {

    // Consulta SQL para obtener los datos de la vista
    $sqlSelectView = "SELECT `producto_id`, `producto_name`, `producto_price`, `producto_idUser`, `category_name`, `Contenido_imagen`
    FROM `V_Productos`";
   
   $result = $mysqli->query($sqlSelectView);


} else {
    // echo "Error al crear la vista: " . $conn->error;
}


// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    echo '<div class="product-center container">';
    // Iterar sobre los resultados y generar los productos
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<div class="overlay">';
        echo '<a href="productDetails.php" class="product-thumb">';
        echo '<img src="' . $row["Contenido_imagen"] . '" alt="" />';
        echo '</a>';
        echo '</div>';
        echo '<div class="product-info">';
        echo '<span>' . $row["category_name"] . '</span>';
        echo '<a href="DetalleProducto.php">' . $row["producto_name"] . '</a>';
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
    echo '</div>';

    // Paginación
    $sql = "SELECT COUNT(*) AS total FROM tb_product";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $limit);

    echo '<section class="pagination">';
    echo '<div class="container">';
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';
    echo '</section>';
} else {
    echo '<p>No se encontraron productos.</p>';
}

$sqlDeleteView = "DROP VIEW V_Productos";

$resultado = $mysqli->query($sqlDeleteView);

?>
