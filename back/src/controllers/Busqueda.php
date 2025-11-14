<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    header('Content-Type: application/json');

    $sort = $json["sortOption"];
    $consulta = $json["consulta"];



    $mysqli = db::connect();

    $busqueda = Product::BusquedaGeneral($mysqli, $consulta, $sort);

    $json_response = ["success" => true];
    if($busqueda) {
        $json_response["msg" ]= "Sí encontró resultados";
        $json_response["busqueda" ]= $busqueda;
        echo json_encode($json_response);
        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No encontró resultados";
        echo json_encode($json_response);
        exit;
    } 
   
}