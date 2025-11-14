
<?php
// Verificar si se ha enviado el ID del chat como un parámetro en la URL
if(isset($_GET['chatId'])) {
    // Obtener el ID del chat desde la URL
    session_start();
    
    $chatId = $_GET['chatId'];

    $_SESSION["INFO_ID_CHAT"] = $chatId;
    
    // Realizar cualquier procesamiento adicional necesario con el ID del chat
    
    // Por ejemplo, puedes usar el ID del chat para realizar consultas en la base de datos o cualquier otra operación
    
    // Ejemplo de respuesta con el ID del chat
    // echo "El ID del chat seleccionado es: " . $chatId;

    //  echo  $_SESSION["chatId"];
    // var_dump($_SESSION["chatId"]);
    header("Location: ../views/Mensajes.php");
    exit;
} else {
    // Si no se proporcionó el ID del chat, mostrar un mensaje de error o redirigir a otra página
    echo "No se proporcionó el ID del chat.";
    exit;
}


// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["chatId"])) {
//     // Obtener el ID del chat desde la solicitud POST
//     $chatId = $_POST["chatId"];

//     var_dump($_POST["chatId"]);
//     var_dump("hola");

//     session_start();

//     // Guardar el ID del chat en la sesión
//     $_SESSION["chat_id"] = $chatId;

//     //var_dump($chatId);

//     // Responder con un mensaje de éxito
//     echo "ID del chat guardado en la sesión";

//     echo json_encode($chatId);
// }



// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Obtener el ID del chat desde la solicitud POST
//     $chatId = $_POST["chatId"];

//     var_dump($_POST["chatId"]);

//     // Guardar el ID del chat en la sesión
//     $_SESSION["chat_id"] = $chatId;

//     //var_dump($chatId);

//     // Responder con un mensaje de éxito
//     echo "ID del chat guardado en la sesión";

//     echo json_encode($chatId);
// }
?>
