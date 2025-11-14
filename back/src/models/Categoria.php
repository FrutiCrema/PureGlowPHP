<?php

class Category {
    private $id;
    private $name;
    private $description;
    private $isEnable;
    private $idUser ;

    public function getId() {
       return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription () {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getIsEnable() {
        return $this->isEnable;
    }

    public function setIsEnable($isEnable) {
        $this->$isEnable = $isEnable;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->$idUser = $idUser;
    }


    public function __construct($id, $name, $description, $isEnable, $idUser) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isEnable = $isEnable;
        $this->idUser = $idUser;
    }

    static public function parseJson($json) {
        // Imprimir el JSON para verificar los datos
        //var_dump($json);
    
        $category = new Category(
            isset($json["id"]) ? $json["id"] : "",
            isset($json["name"]) ? $json["name"] : "",
            isset($json["description"]) ? $json["description"] : "",
            isset($json["isEnable"]) ? $json["isEnable"] : "",
            isset($json["idUser"]) ? $json["idUser"] :  ""

        );
    
        return $category;
    }
    
    public function save($mysqli, $idUser) {
        $sql = "CALL SP_NuevaCategoria(?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $this->name, $this->description, $idUser);
        $stmt->execute();
        $this->id = (int)$stmt->insert_id;
    }

    public static function MostrarResultadoCategoria($mysqli, $idCategory) {
        $sql = "CALL SP_MostrarResultadoCategoria(?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("i", $idCategory);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $categoria = $result->fetch_assoc();
        return $categoria;

    }


    public function obtenerCategorias($mysqli) {
        $category = array();

        // Consulta para obtener las categorías
        $sql = "CALL SP_BuscarCategorias()";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); 

        // Verificar si se encontraron categorías
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category[] = $row;
            }
        }        
        return $category;
    }


    public static function EliminarCategoria($mysqli, $categoryName) {
        $sql = "CALL SP_EliminarCategoria(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s",$categoryName);
        $stmt->execute();
    }

}
