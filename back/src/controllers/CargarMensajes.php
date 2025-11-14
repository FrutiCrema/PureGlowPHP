<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Chat.php";
    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);


    session_start();
    //echo $_SESSION["INFO_ID_CHAT"];

    $idChat = $_SESSION["INFO_ID_CHAT"];
    $idUser = $_SESSION["AUTH"]["user_id"];


    // var_dump($idChat);

    $mysqli = db::connect();
    $mensajes = Chat::TraerHistorialMensajes($mysqli, $idChat);

    //var_dump($chats);

    $json_response = ["success" => true];
    
    if ($mensajes) {
        $json_response["msg"]= "Si trajo chats";
        $json_response["mensajes"] = $mensajes; // Agregar todos los chats al JSON response
        $json_response["idUser"] = $idUser; // Agregar todos los chats al JSON response
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No trajo chats";
    }
    
    header('Content-Type: application/json');
    echo json_encode($json_response);


}