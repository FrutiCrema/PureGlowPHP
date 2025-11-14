<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);


    session_start();
    //echo $_SESSION["INFO_ID_CHAT"];

    $idChat = $_SESSION["INFO_ID_CHAT"];
    // $idUser = $_SESSION["AUTH"]["user_id"];


    // var_dump($idChat);

    $mysqli = db::connect();
    $producto = Product::TraerInfoProductoMensajes($mysqli, $idChat);

    // var_dump($producto);

    $json_response = ["success" => true];
    
    if ($producto) {
        $json_response["msg"]= "Si trajo la informacion del producto";
        $json_response["producto"] = $producto;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No trajo chats";
    }
    
    header('Content-Type: application/json');
    echo json_encode($json_response);


}