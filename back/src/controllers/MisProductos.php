<?php
require_once "../database/db.php";
require_once "../models/Producto.php";


$json = json_decode(file_get_contents('php://input'),true);

$mysqli = db::connect();


session_start();
$idUser = $_SESSION["AUTH"]["user_id"];

$categoria = $json;



$productos = Product::MisProductos($mysqli, $idUser, $categoria,);

// var_dump($productos);

$json_response = ["success" => true];
if($productos) {
    $json_response["msg" ]= "trajo productos";
    $json_response["productos" ]= $productos;

    echo json_encode($json_response);
    exit;
} else {
    $json_response["success"]  = false;
    $json_response["msg"] = "no trajo productos";
    echo json_encode($json_response);
    exit;
} 
?>
