<?php

session_start();

$idUser = $_SESSION["AUTH"]["user_id"];


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    header('Content-Type: application/json');

    $mysqli = db::connect();

    $producto = Product::parseJson($json);

    $producto->EncontrarIdProducto($mysqli,$json["id"], $idUser);

    $json_response = ["success" => true];
    if($producto) {
        $json_response["msg" ]= "Se aprovó el producto";
        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "El producto no se pudo aprovar";
        echo json_encode($producto);
        exit;
    } 
   
}