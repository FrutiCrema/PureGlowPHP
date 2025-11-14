<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Carrito.php";

    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);

    session_start();
    $idUser = $_SESSION["AUTH"]["user_id"];

    $mysqli = db::connect();

    $product = Cart::parseJson($json);
    
    $product->eliminarProductoCarrito($mysqli, $idUser);

    $json_response = ["success" => true, "msg" => "Se ha eliminado el producto"];
    header('Content-Type: application/json');
    echo json_encode($json_response);
}