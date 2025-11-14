<?php

session_start();

$idUser = $_SESSION["AUTH"]["user_id"];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";

    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    

    $mysqli = db::connect();

    // var_dump($idUser);

    $producto = Product::parseJson($json);
    // var_dump($producto);
    // var_dump("hola");


    $producto->AgregarAlCarritoLP($mysqli,$json["id"], $idUser);

    $json_response = ["success" => true];
    if($producto) {
        $json_response["msg" ]= "Se agregó al carrito";

            header('Content-Type: application/json');
            echo json_encode($json_response);

        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "Nos se pudo agregar al carrito";
        echo json_encode($json_response);
        exit;
    } 
   
}


?>
