<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);

    session_start();
    //echo $_SESSION["INFO_ID_CHAT"];

    $idChat = (int)$_SESSION["INFO_ID_CHAT"];
    $idUser = $_SESSION["AUTH"]["user_id"];

    // var_dump($chatId);

    $mysqli = db::connect();
    $product = Product::parseJson($json);
    
    
    $product->EnviarCotizacion($mysqli, $idChat, $idUser);

    // var_dump($product);

    //var_dump($product);

    $json_response = ["success" => true];
    
    if ($product) {
        $json_response["msg"]= "Se envio la cotizacion";
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No se envio la cotizacion";
    }
    
    header('Content-Type: application/json');
    echo json_encode($json_response);
}