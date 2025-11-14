<?php

class Chat {
    private $id;
    private $idSeller;
    private $idBuyer;
    private $idProducto;
    private $userName;
    private $text;

   

    public function getId() {
       return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdSeller() {
        return $this->idSeller;
     }
 
     public function setIdSeller($idSeller) {
         $this->idSeller = $idSeller;
     }

     public function getIdBuyer() {
        return $this->idBuyer;
     }
 
     public function setIdBuyer($idBuyer) {
         $this->idBuyer = $idBuyer;
     }

     public function getIdProducto() {
        return $this->idProducto;
     }
 
     public function setIdProducto($idProducto) {
         $this->idProducto = $idProducto;
     }

     public function getUserName() {
        return $this->userName;
     }
 
     public function setUserName($userName) {
         $this->userName = $userName;
     }

     public function getText() {
        return $this->text;
     }
 
     public function setText($text) {
         $this->text = $text;
     }


    public function __construct($id, $idSeller, $idBuyer, $idProducto, $userName, $text) {
        $this->id = $id;
        $this->idSeller = $idSeller;
        $this->idBuyer = $idBuyer;
        $this->idProducto = $idProducto; 
        $this->userName = $userName;
        $this->text = $text;
    }

    static public function parseJson($json) {
        // Imprimir el JSON para verificar los datos
        //var_dump($json);
    
        $chat = new Chat(
            isset($json["id"]) ? $json["id"] : "",
            isset($json["idSeller"]) ? $json["idSeller"] : "",
            isset($json["idBuyer"]) ? $json["idBuyer"] : "",
            isset($json["idProducto"]) ? $json["idProducto"] : "",
            isset($json["userName"]) ? $json["userName"] : "",
            isset($json["text"]) ? $json["text"] : ""
        );
    
        return $chat;
    }
        

    
    // public function save($mysqli) {
    //     //$sql = "INSERT INTO users (names, lastnames, username, email, password) VALUES (?,?,?,?,?)";
    //     $sql = "CALL SP_Signup(?,?,?,?,?,?,?,?,?)";
    //     $stmt= $mysqli->prepare($sql);
    //     $stmt->bind_param("sssissssi", $this->email, $this->username, $this->password, $this->role, $this->image, $this->name, $this->birthday, $this->gender, $this->isPublic);
    //     $stmt->execute();
    //     $this->id = (int)$stmt->insert_id;
    // }

        public static function TraerHistorialChats($mysqli, $idUser) {
        $sql = "CALL SP_Chats(?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("i", $idUser);
        $stmt->execute();

        $result = $stmt->get_result();

        $chats = array(); // Array para almacenar todos los chats
    
        while ($row = $result->fetch_assoc()) {
            $chats[] = $row; // Agregar cada chat al array de chats
        }
    
        return $chats;    
        }


        public static function TraerHistorialMensajes($mysqli, $idChat) {
            $sql = "CALL SP_MostrarMensajes(?)";
            $stmt= $mysqli->prepare($sql);
            $stmt->bind_param("i", $idChat);
            $stmt->execute();
    
            $result = $stmt->get_result();
    
            $mensajes = array(); // Array para almacenar todos los chats
        
            while ($row = $result->fetch_assoc()) {
                $mensajes[] = $row; // Agregar cada chat al array de chats
            }
        
            return $mensajes;    
        }

        public function GuardarMensaje($mysqli, $idChat, $idUser) {
        $sql = "CALL SP_MandarMensaje(?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("iis", $idChat, $idUser, $this->text);
        $stmt->execute();
    }

    
}
