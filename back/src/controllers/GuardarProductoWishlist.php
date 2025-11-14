<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);

    session_start();
    $idUser = $_SESSION["AUTH"]["user_id"];

    $favoritos = $json["favoritos"];
    $idWishlist = $favoritos[0];
    
    $idProduct = $_SESSION["INFO_PRODUCT"]['producto_id'];
    

    header('Content-Type: application/json');

    $mysqli = db::connect();
    $wishlists = Product::InsertarProductoWishlist($mysqli, $idWishlist, $idProduct);


    $json_response = ["success" => true];
    if(!$wishlists) {
        $json_response["msg" ]= "Se guardó producto en la wishlist";
        echo json_encode($json_response);
        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No se guardó producto en la wishlist";
        echo json_encode($json_response);
        exit;
    } 
   
}