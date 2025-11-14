<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el objeto JSON enviado por AJAX
    $json = json_decode(file_get_contents('php://input'), true);

    session_start();

    $idUser = $_SESSION["AUTH"]["user_id"];

    // Verifica si se recibieron datos válidos
    if (!empty($json['productos'])) {
        // Incluye los archivos necesarios
        require_once "../database/db.php";
        require_once "../models/Producto.php";

        // Conectarse a la base de datos
        $mysqli = db::connect();

        // Recibe los datos de los productos enviados por AJAX
        $productos = $json['productos'];

        // Recorre cada producto y guarda la puntuación y el comentario en la base de datos
        foreach ($productos as $producto) {
            $idProducto = $producto['productId'];
            $rating = $producto['rating'];
            $comment = $producto['comment'];

            // Guarda la puntuación y el comentario en la base de datos
            $success = Product::GuardarPuntuacion($mysqli, $idProducto, $rating, $comment, $idUser);

            // Maneja la respuesta según sea necesario
            if (!$success) {
                // Hubo un error al guardar la puntuación, puedes manejarlo aquí
            }
        }

        if (isset($_SESSION["PRODUCTOS_CARRITO"])) {
            unset($_SESSION["PRODUCTOS_CARRITO"]);
          
          }
          
        // Enviar una respuesta al cliente
        $response = ["success" => true, "message" => "Puntuaciones guardadas correctamente"];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // No se enviaron datos válidos
        $response = ["success" => false, "message" => "No se enviaron datos válidos"];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {
    // La solicitud no fue de tipo POST
    $response = ["success" => false, "message" => "La solicitud no fue de tipo POST"];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
