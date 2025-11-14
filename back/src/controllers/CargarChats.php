<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Chat.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    session_start();
    $idUser = $_SESSION["AUTH"]["user_id"];

    //var_dump($idChat);

    $mysqli = db::connect();
    $chats = Chat::TraerHistorialChats($mysqli, $idUser);

    // var_dump($idChat);
    // var_dump($idUser);

    $json_response = ["success" => true];
    
    if ($chats) {
        $json_response["msg"]= "Si trajo chats";
        $json_response["chats"] = $chats; // Agregar todos los chats al JSON response
        
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No trajo chats";
    }
    
    header('Content-Type: application/json');
    echo json_encode($json_response);

}