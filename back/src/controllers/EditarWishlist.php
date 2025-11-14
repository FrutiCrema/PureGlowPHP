<?php
require_once "../database/db.php";
require_once "../models/Producto.php";


$json = json_decode(file_get_contents('php://input'),true);


$mysqli = db::connect();

$idWishlist = $json["idWishlist"];
$name = $json["name"];
$description = $json["description"];
$isPublicWL = $json["isPublicWL"];


$actualizar = Product::ActualizarLista($mysqli, $idWishlist, $name, $description, $isPublicWL);



$json_response = ["success" => true];
if(!$actualizar) {
    $json_response["msg" ]= "Se actualizó la lista";

    echo json_encode($json_response);
    exit;
} else {
    $json_response["success"]  = false;
    $json_response["msg"] = "No se pudo actualizar";
    echo json_encode($json_response);
    exit;
} 
?>


