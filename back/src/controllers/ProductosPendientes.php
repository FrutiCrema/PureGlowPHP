<?php
require_once "../database/db.php";

$mysqli = db::connect();

// Consulta SQL para obtener los primeros 25 productos de la vista
$sql = "SELECT * FROM V_ProductosPendientes  LIMIT 25";
$result = $mysqli->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Iterar sobre los resultados y generar el HTML para cada producto
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
            echo '<div class="overlay">';
                echo '<a class="product-thumb">';
                echo '<img src="' . $row["Contenido_imagen"] . '" alt="" />';
                echo '</a>';
            echo '</div>';
            echo '<div class="product-info">';
            echo '<span>' . $row["Categoría"] . '</span>';
            echo '<a>' . $row["Nombre"] . '</a>';
            echo '<h4>$' . $row["Precio"] . '</h4>';
            echo '</div>';
            echo '<div>';
            echo '<button type="submit" class="admitir-btn" value="' . $row["IdP"] . '">Admitir</button>';
            echo '</div>';
        echo '</div>';
    }
} else {
    echo "No se encontraron productos.";
}

?>


<script src="/PureGlow/back/src/js/AdmitirProducto.js"></script>
