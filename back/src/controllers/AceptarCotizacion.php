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
    $idProducto = Product::AceptarCotizacion($mysqli, $idChat, $idUser);


    // var_dump( $idProducto);

    $_SESSION["PRODUCTOS_MENSAJES"] =  $idProducto;

    // var_dump($_SESSION["PRODUCTOS_MENSAJES"]);

    //var_dump($product);

    $json_response = ["success" => true];
    $json_response["msg"]= "Se acepto la cotizacion";
   
    
    header('Content-Type: application/json');
    echo json_encode($json_response);
}