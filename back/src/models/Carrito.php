<?php

class Cart {
    private $id;
    private $idUser;
    private $idProducto;
    private $name;
    private $price;
    private $quantity;

    public function getId() {
       return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->$idUser = $idUser;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto) {
        $this->$idProducto = $idProducto;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }



    public function __construct($id, $idUser, $idProducto, $name, $price, $quantity) {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->idProducto = $idProducto;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    static public function parseJson($json) {
        // Imprimir el JSON para verificar los datos
        //var_dump($json);
    
        $cart = new Cart(
            isset($json["id"]) ? $json["id"] : "",
            isset($json["idUser"]) ? $json["idUser"] : "",
            isset($json["idProducto"]) ? $json["idProducto"] : "",
            isset($json["name"]) ? $json["name"] : "",
            isset($json["price"]) ? $json["price"] :  "",
            isset($json["quantity"]) ? $json["quantity"] :  ""

        );
    
        return $cart;
    }
    
    // public function save($mysqli, $idUser) {
    //     $sql = "CALL SP_NuevaCategoria(?,?,?)";
    //     $stmt= $mysqli->prepare($sql);
    //     $stmt->bind_param("ssi", $this->name, $idUser);
    //     $stmt->execute();
    //     $this->id = (int)$stmt->insert_id;
    // }

    public function eliminarProductoCarrito($mysqli, $idUser) {
        $sql = "CALL SP_EliminarProductoCarrito(?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("ii", $idUser, $this->idProducto);
        $stmt->execute();
    }

    public static function obtenerCarrito($mysqli, $idUser) {
        $cart = array();

        $sql = "CALL SP_BuscarCategorias(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        return $stmt->get_result(); 
    }
}
