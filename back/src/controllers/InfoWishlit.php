<?php
require_once "../database/db.php";
require_once "../models/Producto.php";


$json = json_decode(file_get_contents('php://input'),true);


$mysqli = db::connect();

$idWishlist = $json["id"];



$info = Product::TraerInfoWishlist($mysqli, $idWishlist);


foreach ($info as &$product) {
    // Aquí puedes realizar cualquier procesamiento adicional necesario para cada producto
    // Por ejemplo, dar formato a los precios, agregar nuevas propiedades, etc.
}

$json_response = ["success" => true];
if($info) {
    $json_response["msg" ]= "Cargando";

    $json_response["info" ]= $info;
    echo json_encode($json_response);
    exit;
} else {
    $json_response["success"]  = false;
    $json_response["msg"] = "No hay objetos";
    echo json_encode($json_response);
    exit;
} 
?>


