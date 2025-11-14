<?php
global $_PRODUCT;

$_PRODUCT = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    header('Content-Type: application/json');

    $mysqli = db::connect();

    // $producto = Product::parseJson($json);
    $producto = Product::MostrarDetalleProducto($mysqli,$json["id"]);

        // var_dump($producto);

    $json_response = ["success" => true];
    if($producto) {
        $json_response["msg" ]= "Se mostró con éxito";

        session_start();
        $_SESSION["INFO_PRODUCT"] = $producto;

        echo json_encode($json_response);
        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No se puede mostrar";
        echo json_encode($producto);
        exit;
    } 
   
}


?>
