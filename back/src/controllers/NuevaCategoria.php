<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Categoria.php";


    session_start();
    $idUser = $_SESSION["AUTH"]["user_id"];

    header('Content-Type: application/json');

    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    $mysqli = db::connect();
    $categoria = Category::parseJson($json);



    // Intentar guardar la categoría
    $resultado = $categoria->save($mysqli, $idUser);
    
    $json_response = ["success" => true];

    if ($categoria) {
        // La inserción fue exitosa
        $json_response = ["success" => true, "msg" => "Se ha agregado la categoría"];
        echo json_encode($json_response);
        exit;
    } else {
        // Ocurrió un error durante la inserción (por ejemplo, categoría duplicada)
        $json_response = ["success" => false, "msg" => "Error al agregar la categoría. Puede que la categoría ya exista."];
        echo json_encode($json_response);
        exit;
    }
    
}