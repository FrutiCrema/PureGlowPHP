<?php
require_once "../database/db.php";
require_once "../models/Producto.php";


$json = json_decode(file_get_contents('php://input'),true);

$mysqli = db::connect();

session_start();
$idUser = $_SESSION["AUTH"]["user_id"];

// Suponiendo que las fechas vienen en formato 'YYYY-MM-DD' en $json
$fechaInicio = $json['fechaInicio'];

// Convertir las fechas a objetos DateTime
$dateInicio = new DateTime($fechaInicio);

// Formatear las fechas para obtener solo el mes y el año
$mesInicio = $dateInicio->format('m'); // Formato 'MM'
$anioInicio = $dateInicio->format('Y'); // Formato 'YYYY'

$categoria = $json['categoria'];


$compras = Product::ConsultaVentasAgrupadas($mysqli, $idUser, $mesInicio, $anioInicio, $categoria);


// var_dump($compras);


$json_response = ["success" => true];
if($compras) {
    $json_response["msg" ]= "trajo venta";
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
