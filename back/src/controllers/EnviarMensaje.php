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

    // var_dump($chatId);

    $mysqli = db::connect();
    $mensaje = Chat::parseJson($json);
    
    
    $mensaje->GuardarMensaje($mysqli, $idChat, $idUser);

    //var_dump($chats);

    $json_response = ["success" => true];
    
    if ($mensaje) {
        $json_response["msg"]= "Se guardo el mensaje";
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No se guardo el mensaje";
    }
    
    header('Content-Type: application/json');
    echo json_encode($json_response);
}