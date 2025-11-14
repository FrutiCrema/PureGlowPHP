<?php
require_once "../database/db.php";
require_once "../models/Producto.php";
// var_dump("entre");


session_start();
$idUser = $_SESSION["AUTH"]["user_id"];

$mysqli = db::connect();

$json = json_decode(file_get_contents('php://input'),true);


$productId = $json['productId'];
$quantity = $json['quantity'];
    
    // $productId = $_POST['productId'];
// $quantity = $_POST['quantity'];

// $productId = $json['idProducto'];
// $quantity = $json['quantity'];

// var_dump("entre");
// var_dump($productId);
// var_dump($quantity);


$mysqli = db::connect();
$producto = Product::ActualizarCantidadCarrito($mysqli, $quantity, $productId, $idUser);

//  var_dump($producto);



$json_response = ["success" => true];
if($producto) {
    $json_response["msg" ]= "Se actualizó la cantidad";
    $json_response["producto" ]= $producto;

        header('Content-Type: application/json');
        echo json_encode($json_response);


    exit;
} else {
    $json_response["success"]  = false;
    $json_response["msg"] = "Nos se pudo actualizar la cantidad";
    echo json_encode($producto);
    exit;
} 
?>
