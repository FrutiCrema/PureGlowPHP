<?php
require_once "../database/db.php";
require_once "../models/Producto.php";


$json = json_decode(file_get_contents('php://input'),true);

$mysqli = db::connect();

session_start();
$idUser = $_SESSION["AUTH"]["user_id"];

// Obtener datos del formulario (suponiendo que se enviaron por POST)
$fechaInicio = $json['fechaInicio'];
$fechaFin = $json['fechaFin'];
$categoria = $json['categoria'];


$compras = Product::ConsultaCompras($mysqli, $idUser, $fechaInicio, $fechaFin, $categoria);


$json_response = ["success" => true];
if($compras) {
    $json_response["msg" ]= "trajo compras";
    $json_response["compras" ]= $compras;

    echo json_encode($json_response);
    exit;
} else {
    $json_response["success"]  = false;
    $json_response["msg"] = "no trajo compras";
    echo json_encode($json_response);
    exit;
} 
?>
