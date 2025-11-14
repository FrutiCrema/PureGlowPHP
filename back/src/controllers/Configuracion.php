<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/User.php";

    // Obtener JSON enviado en la solicitud
    $json = json_decode(file_get_contents('php://input'), true);

    session_start();

    $usernameOriginal = $_SESSION["AUTH"]["user_userName"];

    //var_dump($usernameOriginal);


    // Verificar si el JSON contiene los datos necesarios
    if (isset($json["username"])) {
        // Conectar a la base de datos
        $mysqli = db::connect();

        // Actualizar los datos del usuario con los nuevos datos del JSON
        // Aquí asumimos que el método `parseJson` actualiza los atributos del usuario con los datos del JSON
        $user = User::parseJson($json);
        
        // Verificar si se encontró el usuario
        if ($user->getUsername() !== null) {

            // Guardar los cambios en la base de datos
            $user->modifyUser($mysqli, $usernameOriginal);

            //Buscamos en la BD el usuario que acabamos de modificar
            $user2 = User::findUserByUsername($mysqli, $json["username"]);
            
            //Se lo volvemos a asignar a la variable para que se refleje en la página
            $_SESSION["AUTH"] = $user2;

            // Enviar respuesta de éxito
            $json_response = ["success" => true, "msg" => "Se ha actualizado el usuario"];
            header('Content-Type: application/json');
            echo json_encode($json_response);
        } else {
            // Enviar respuesta de error si no se encontró el usuario
            $json_response = ["success" => false, "msg" => "El usuario no existe"];
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode($json_response);
        }

        // Cerrar la conexión a la base de datos
        $mysqli->close();
    } else {
        // Enviar respuesta de error si faltan datos en el JSON
        $json_response = ["success" => false, "msg" => "Datos incompletos en la solicitud"];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($json_response);
    }
}
?>
