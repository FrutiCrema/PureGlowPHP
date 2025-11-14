<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/User.php";

    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    $mysqli = db::connect();
    $user = User::parseJson($json);
    $user->save($mysqli);
    $idEcontrado = $user->findUserById($mysqli, $user->getId());
    //$names = $user->getUsername();
    $json_response = ["success" => true, "msg" => "Se ha creado el usuario"];
    header('Content-Type: application/json');
    echo json_encode($json_response);
}