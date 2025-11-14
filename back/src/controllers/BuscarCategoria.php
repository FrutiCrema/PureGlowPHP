<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Categoria.php";
    
    // Obtener JSON
    $json = json_decode(file_get_contents('php://input'), true);

    header('Content-Type: application/json');

    $mysqli = db::connect();
    $category = Category::obtenerCategorias($mysqli);
    $json_response = ["success" => true];

    if($category) {
        // Enviar las categorías como respuesta JSON
        echo json_encode($category);
        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No se encontraron categorías";
        echo json_encode($json_response);
        exit;
    } 
}
?>
