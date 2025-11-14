<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);

    session_start();
    $idUser = $_SESSION["AUTH"]["user_id"];
    

    // var_dump($idUser);

    header('Content-Type: application/json');

    $mysqli = db::connect();
    $wishlists = Product::TraerWishlist($mysqli,$idUser);

    // var_dump($wishlists);

    $json_response = ["success" => true];
    if($wishlists) {
        $json_response["msg" ]= "Sí trajo listas";
        $json_response["whistlist" ]= $wishlists;
        echo json_encode($json_response);
        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No trajop listas";
        echo json_encode($json_response);
        exit;
    } 
   
}