<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json

    session_start();
    $json = json_decode(file_get_contents('php://input'),true);


    $idWishlist = $json["id"];
    
    header('Content-Type: application/json');

    $mysqli = db::connect();
    $whislist = Product::EliminarProducto($mysqli, $idWishlist);
    
    $json_response = ["success" => true];
    
    
        $json_response["msg" ]= "Se ha eliminado la lista";
       
        
        echo json_encode($json_response);
        exit;
    
   
}