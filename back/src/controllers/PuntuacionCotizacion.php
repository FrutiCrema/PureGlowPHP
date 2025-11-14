<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el objeto JSON enviado por AJAX
    $json = json_decode(file_get_contents('php://input'), true);

    session_start();

    $idUser = $_SESSION["AUTH"]["user_id"];

    // Verificar si se recibieron datos válidos
    if (!empty($json['producto'])) {
        // Incluir los archivos necesarios
        require_once "../database/db.php";
        require_once "../models/Producto.php";

        // Conectar a la base de datos
        $mysqli = db::connect();

        // Recibir los datos del producto enviado por AJAX
        $producto = $json['producto'];

        // Extraer los datos del producto
        $idProducto = $producto['productId'];
        $rating = $producto['rating'];
        $comment = $producto['comment'];

        // Guardar la puntuación y el comentario en la base de datos
        $success = Product::GuardarPuntuacion($mysqli, $idProducto, $rating, $comment, $idUser);

        // Manejar la respuesta según sea necesario
        if (!$success) {
            // Hubo un error al guardar la puntuación, puedes manejarlo aquí
        }

        // Si se guardó correctamente, eliminar el producto del carrito
        if (isset($_SESSION["PRODUCTOS_MENSAJES"])) {
            unset($_SESSION["PRODUCTOS_MENSAJES"]);
        }

        // Enviar una respuesta al cliente
        $json_response = ["success" => true, "msg" => "Puntuación guardada correctamente"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;
    } else {
        // No se recibieron datos válidos
        $json_response = ["success" => false, "msg" => "No se recibieron datos válidos"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;
    }
} else {
    // La solicitud no fue de tipo POST
    $json_response = ["success" => false, "msg" => "La solicitud no fue de tipo POST"];
    header('Content-Type: application/json');
    echo json_encode($json_response);
    exit;
}
?>
