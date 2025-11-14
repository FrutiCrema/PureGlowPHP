<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/User.php";
    //Obtener Json

    session_start();
    $json = json_decode(file_get_contents('php://input'),true);


    $idUser = $json["id"];
    
    header('Content-Type: application/json');
    $mysqli = db::connect();
    $user = User::EliminarUsuario($mysqli, $idUser);
    
    $json_response = ["success" => true];
    
    
        $json_response["msg" ]= "Se ha eliminado el usuario";

        unset($_SESSION["AUTH"]);
       
        
        echo json_encode($json_response);
        exit;
    
   
}