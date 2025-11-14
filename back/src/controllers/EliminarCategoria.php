<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Categoria.php";
    //Obtener Json

    session_start();
    $json = json_decode(file_get_contents('php://input'),true);


    $categoryName = $json["category"];
    
    header('Content-Type: application/json');
    $mysqli = db::connect();

    $category = Category::EliminarCategoria($mysqli, $categoryName);
    
    $json_response = ["success" => true];
    

    

    if(!$category) {
        $json_response["msg" ]= "Se ha eliminado la categoría";   
        
        echo json_encode($json_response);
        exit;
    } else {
        $json_response["msg" ]= "No se pudo eliminar la categoría";   
    
        echo json_encode($json_response);
        exit;
            exit;
    } 
   
}