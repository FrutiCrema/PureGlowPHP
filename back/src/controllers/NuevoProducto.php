<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";

    session_start();
    $idUser = $_SESSION["AUTH"]["user_id"];
    //var_dump("hola");

    // Obtener JSON y datos de archivo
    if (isset($_POST['json'])) {
        $json = json_decode($_POST['json'], true);
    } else {
        $json_response = ["success" => false, "msg" => "Datos del producto no recibidos."];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;
    }

    //var_dump($json);

    $mysqli = db::connect();
    $product = Product::parseJson($json);

    // Primero guardo el producto nuevo
    $product->save($mysqli, $idUser);

    // Después traigo el último id del producto creado
    $idProducto = $product->lastIdProduct($mysqli);

    $idProducto = $idProducto["last_product_id"];
    //var_dump($idProducto);


    // Después asigno la nueva ruta
    $directorio_destino = "../../../front/videos/{$idUser}/{$idProducto}";

    // Crear el directorio si no existe
    if (!file_exists($directorio_destino)) {
        mkdir($directorio_destino, 0777, true);
    }

    // Mover el archivo a la ruta definida
    if (isset($_FILES['video'])) {
        $video = $_FILES['video'];
        $ruta_completa_video = "{$directorio_destino}/{$video['name']}";
        move_uploaded_file($video['tmp_name'], $ruta_completa_video);


        // var_dump($ruta_completa_video);
        // Después guardo el video en la tabla de videos con el último id del producto creado
        $product->saveVideo($mysqli, $idProducto, $ruta_completa_video);
    }

    $json_response = ["success" => true, "msg" => "Se ha agregado el producto"];
    header('Content-Type: application/json');
    echo json_encode($json_response);
}
?>
