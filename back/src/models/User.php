<?php

class User {
    private $id;
    private $email;
    private $username;
    private $password;
    private $name;
    private $birthday;
    private $image;
    private $isPublic;
    private $gender;
    private $role;

    public function getId() {
       return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername () {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->$name = $name;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function setBirthday($birthday) {
        $this->$birthday = $birthday;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->$image = $image;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->$gender = $gender;
    }

    public function getIsPublic() {
        return $this->isPublic;
    }

    public function setIsPublic($isPublic) {
        $this->$isPublic = $isPublic;
    }


    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->$role = $role;
    }



    public function __construct($email, $username, $password, $name, $birthday, $image, $gender, $isPublic, $role) {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name; 
        $this->birthday = $birthday;
        $this->image = $image;
        $this->gender = $gender;
        $this->isPublic = $isPublic;
        $this->role = $role;
    }

    static public function parseJson($json) {
        // Imprimir el JSON para verificar los datos
        //var_dump($json);
    
        $user = new User(
            isset($json["email"]) ? $json["email"] : "",
            isset($json["username"]) ? $json["username"] : "",
            isset($json["password"]) ? $json["password"] : "",
            isset($json["name"]) ? $json["name"] : "",
            isset($json["birthdate"]) ? $json["birthdate"] : "",
            isset($json["avatar"]) ? $json["avatar"] : "",
            isset($json["gender"]) ? $json["gender"] : "",
            isset($json["visibility"]) ? $json["visibility"] : "",
            isset($json["role"]) ? $json["role"] :  ""
        );
    
        // Imprimir el objeto User para verificar si se crea correctamente
        
        //var_dump($user);

        return $user;
    }
        

    
    public function save($mysqli) {
        //$sql = "INSERT INTO users (names, lastnames, username, email, password) VALUES (?,?,?,?,?)";
        $sql = "CALL SP_Signup(?,?,?,?,?,?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("sssissssi", $this->email, $this->username, $this->password, $this->role, $this->image, $this->name, $this->birthday, $this->gender, $this->isPublic);
        $stmt->execute();
        $this->id = (int)$stmt->insert_id;
    }


    public function modifyUser($mysqli, $usernameOriginal) {
        //$sql = "SELECT user_id, user_email, user_userName, user_email FROM TB_User WHERE  user_userName = ? AND user_password = ? LIMIT 1";
        $sql = "CALL SP_UpdateUser(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssssss", $this->username, $this->email, $this->password, $this->name, $this->birthday, $this->image, $this->gender, $usernameOriginal);
        $stmt->execute();        
    }


    public function modifyUser4($mysqli) {
        $sql = "CALL SP_EditarUsuario(?,?,?,?,?,?,?)";     
        
        // Preparar la consulta
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            // Manejo del error si la preparación de la consulta falla
            echo "Error al preparar la consulta: " . $mysqli->error;
            return false; // Otra acción apropiada, como lanzar una excepción
        }
    
        // Enlazar los parámetros de la consulta
        $stmt->bind_param("sssssss", $this->username, $this->email, $this->password, $this->name, $this->birthday, $this->image, $this->gender);
        if (!$stmt->execute()) {
            // Manejo del error si la ejecución de la consulta falla
            echo "Error al ejecutar la consulta: " . $stmt->error;
            return false; // Otra acción apropiada, como lanzar una excepción
        }
    
        // Obtener el ID del usuario modificado
        $this->id = (int)$stmt->insert_id;
    
        // Cerrar la consulta preparada
        $stmt->close();
    
        return true; // Indicar éxito
    }
    
    
    public static function findUserByUsernameEmail($mysqli, $username, $password) {
        //$sql = "SELECT user_id, user_email, user_userName, user_email FROM TB_User WHERE  user_userName = ? AND user_password = ? LIMIT 1";
        $sql = "CALL SP_login(?, ?)";


        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss",$username, $password);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();

        //var_dump($user);

        return $user;
    }


    public static function EliminarUsuario($mysqli, $idUser) {
        $sql = "CALL SP_ELiminarUsuario(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i",$idUser);
        $stmt->execute();
    }


    public static function findUserByUser($mysqli, $username) {
        $sql = "CALL SP_EncontrarUsername(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();
        return $user;
    }

    public static function findUserById($mysqli, $id) {
        //$sql = "SELECT id, names, lastnames, username, email FROM users WHERE  id = ? LIMIT 1";
        $sql = "CALL SP_FoudIdUser(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();
        return $user ? User::parseJson($user) : NULL;
    }

    public function toJSON() {
        return get_object_vars($this);
    }




    public static function findUserByUsername($mysqli, $username) {
        //$sql = "SELECT id, names, lastnames, username, email FROM users WHERE  id = ? LIMIT 1";
        $sql = "CALL SP_EncontrarUsername(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();
        return $user;
    }


    public static function validPassword($mysqli, $password) {
        //$sql = "SELECT id, names, lastnames, username, email FROM users WHERE  id = ? LIMIT 1";
        $sql = "CALL SP_FoudIdUser(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s",$password);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();
        return $user ? User::parseJson($user) : NULL;
    }


}
