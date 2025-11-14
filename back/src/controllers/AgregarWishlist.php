<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../database/db.php";
    require_once "../models/Producto.php";

    session_start();
    $idUser = $_SESSION["AUTH"]["user_id"];

    $json = json_decode(file_get_contents('php://input'),true);

    $name = $json["name"];
    $description = $json["description"];
    $isPublic = $json["isPublicWL"];

    $mysqli = db::connect();
    $product = Product::AgregarWishList($mysqli,$idUser, $name, $description, $isPublic);
    // $productWishlist = Product::AgregarProductoWishList($mysqli,$idUser, $name, $description, $isPublic);



    $json_response = ["success" => true, "msg" => "Se ha agregado el producto"];

    if(!$product) {
        $json_response["msg" ]= "Se ha agregado la lista";
        echo json_encode($json_response);
        exit;
    } else {
        $json_response["success"]  = false;
        $json_response["msg"] = "No se pudo agregar la lista";
        echo json_encode($json_response);
        exit;

    header('Content-Type: application/json');
    echo json_encode($json_response);
    }
}
?>
