<?php
require_once "../database/db.php";

$mysqli = db::connect();

// Consulta SQL para obtener nombres de categorías
$sql = "SELECT category_name FROM tb_category WHERE category_id != 1";
$result = $mysqli->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    echo '<label for="categoria">Selecciona una categoría:</label>';
    echo '<select id="categoria" name="categoria" required>';
    
    // Iterar sobre los resultados y generar las opciones del select
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row["category_name"] . '">' . $row["category_name"] . '</option>';
    }
    
    echo '</select>';
} else {
    // Si no se encontraron categorías
    echo '<p>No hay categorías disponibles.</p>';
}
?>
