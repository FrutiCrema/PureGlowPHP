<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    session_start();
    $idChat = $_SESSION["INFO_ID_CHAT"];

    //var_dump($idChat);

    $mysqli = db::connect();
    $producto = Product::TraerCotizacion($mysqli, $idChat);

    // var_dump($idChat);
    // var_dump($idUser);

    $json_response = ["success" => true];
    
    if ($producto) {
        $json_response["msg"]= "Si trajo chats";
        $json_response["cotizacion"] = $producto; // Agregar todos los chats al JSON response
        
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No trajo chats";
    }
    
    header('Content-Type: application/json');
    echo json_encode($json_response);

}