<?php

class Product {
    private $id;
    private $name;
    private $description;
    private $category;    
    private $isApproved;
    private $quotation;
    private $price;
    private $quantityAvailable;
    private $isEnable;
    private $idUser;
    private $idAdmin;
    private array $image;
    private $video;
    private $priceAgreed;
    private $specifications;

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

    public function getCategory () {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getIsApproved() {
        return $this->isApproved;
    }

    public function setIsApproved($isApproved) {
        $this->isApproved = $isApproved;
    }

    public function getQuotation() {
        return $this->quotation;
    }

    public function setQuotation($quotation) {
        $this->quotation = $quotation;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getQuantityAvailable() {
        return $this->quantityAvailable;
    }

    public function setQuantityAvailable($quantityAvailable) {
        $this->quantityAvailable = $quantityAvailable;
    }

    public function getIsEnable() {
        return $this->isEnable;
    }

    public function setIsEnable($isEnable) {
        $this->isEnable = $isEnable;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }


    public function getIdAdmin() {
        return $this->idAdmin;
    }

    public function setIdAdmin($idAdmin) {
        $this->idAdmin = $idAdmin;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getVideo() {
        return $this->video;
    }

    public function setVideo($video) {
        $this->video = $video;
    }

    public function getPriceAgreed() {
        return $this->priceAgreed;
    }

    public function setPriceAgreed($priceAgreed) {
        $this->priceAgreed = $priceAgreed;
    }

    public function getSpecifications() {
        return $this->specifications;
    }

    public function setSpecifications($specifications) {
        $this->specifications = $specifications;
    }


    public function __construct($id, $name, $description, $category, $isApproved, $quotation, $price, $quantityAvailable, $isEnable, $idUser, $idAdmin, $image, $video, $priceAgreed, $specifications) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->isApproved = $isApproved; 
        $this->quotation = $quotation;
        $this->price = $price;
        $this->quantityAvailable = $quantityAvailable;
        $this->isEnable = $isEnable;
        $this->idUser = $idUser;
        $this->idAdmin = $idAdmin;
        $this->priceAgreed = $priceAgreed;
        $this->specifications = $specifications;

        if (is_array($image)) {
            $this->image = $image;
        } else {
            // Si no se proporciona una imagen, asignar un array vacío
            $this->image = [];
        }

        $this->video = $video;
    }

    static public function parseJson($json) {
        // Imprimir el JSON para verificar los datos
        //var_dump($json);
    
        $product = new Product(
            isset($json["id"]) ? $json["id"] : "",
            isset($json["name"]) ? $json["name"] : "",
            isset($json["description"]) ? $json["description"] : "",
            isset($json["category"]) ? $json["category"] : "",
            isset($json["isApproved"]) ? $json["isApproved"] : "",
            isset($json["quotation"]) ? $json["quotation"] : "",
            isset($json["price"]) ? $json["price"] : "",
            isset($json["quantityAvailable"]) ? $json["quantityAvailable"] : "",
            isset($json["isEnable"]) ? $json["isEnable"] : "",
            isset($json["idUser"]) ? $json["idUser"] :  "",
            isset($json["idAdmin"]) ? $json["idAdmin"] :  "",
            isset($json["image"]) ? $json["image"] :  "",
            isset($json["video"]) ? $json["video"] :  "",
            isset($json["priceAgreed"]) ? $json["priceAgreed"] :  "",
            isset($json["specifications"]) ? $json["specifications"] :  ""
        );
    
        return $product;
    }
        

    
    public function save($mysqli, $idUser) { //editar
        $sql = "CALL SP_NuevoProducto(?,?,?,?,?,?,?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("ssidiissss", $this->name, $this->description, $this->quotation, $this->price, $this->quantityAvailable, $idUser, $this->category, $this->image[0],  $this->image[1],  $this->image[2]);
        $stmt->execute();
        $this->id = (int)$stmt->insert_id;
    }

    public static function GuardarPuntuacion($mysqli, $idProducto, $rating, $comment,$idUser) {
        $sql = "CALL SP_GuardarRating(?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("iisi",$idProducto, $rating, $comment, $idUser);
        $stmt->execute();
    }


    public static function AgregarWishList($mysqli, $idUser, $name, $description, $isPublic) {
        $sql = "CALL SP_AgregarWishList(?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("issi",$idUser, $name, $description, $isPublic);
        $stmt->execute();
    }

    public static function AgregarProductoWishList($mysqli, $idUser, $name, $description, $isPublic) {
        $sql = "CALL SP_AgregarWishList(?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("issi",$idUser, $name, $description, $isPublic);
        $stmt->execute();
    }


    public static function InsertarProductoWishlist($mysqli, $idWishlist, $idProduct) {
        $sql = "CALL SP_InsertarProductoWishlist(?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("ii", $idWishlist, $idProduct);
        $stmt->execute();
    }


    public static function TraerWishlist($mysqli, $idUser) {
        $sql = "CALL SP_TraerWishlists(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        
        $result = $stmt->get_result(); 
        $wishlists = []; // Inicializar un array para almacenar las listas de deseos
    
        // Iterar sobre cada fila de resultados y almacenarla en el array
        while ($row = $result->fetch_assoc()) {
            $wishlists[] = $row;
        }
    
        return $wishlists;
    }
    


    public static function TraerWishlistPerfil($mysqli, $idUser) {
        $sql = "CALL SP_TraerWishlists(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        
        $result = $stmt->get_result(); 
        return $result;
    }



    public static function TraerInfoWishlist($mysqli, $idWishlist) {
        $sql = "CALL SP_TaerInfoWishlist(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $idWishlist);
        $stmt->execute();
        
        $result = $stmt->get_result(); 
        $wishlists = []; // Inicializar un array para almacenar las listas de deseos
    
        // Iterar sobre cada fila de resultados y almacenarla en el array
        while ($row = $result->fetch_assoc()) {
            $wishlists[] = $row;
        }
    
        return $wishlists;
    }


    


    public static function BusquedaGeneral($mysqli, $consulta, $sort) {
        $sql = "CALL BuscarProductos(?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $consulta, $sort);
        $stmt->execute();
        
        $result = $stmt->get_result(); 
        $wishlists = []; // Inicializar un array para almacenar las listas de deseos
    
        // Iterar sobre cada fila de resultados y almacenarla en el array
        while ($row = $result->fetch_assoc()) {
            $wishlists[] = $row;
        }
    
        return $wishlists;
    }



    public static function EliminarProducto($mysqli, $idWishlist) {
        $sql = "CALL SP_EliminarWishlist(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i",$idWishlist);
        $stmt->execute();
    }

    public static function ActualizarLista($mysqli, $idWishlist, $name, $description, $isPublicWL) {
        $sql = "CALL SP_ActualizarWishlist(?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("issi", $idWishlist, $name, $description, $isPublicWL);
        $stmt->execute();
    }


    
    public static function ActualizarCantidadCarrito($mysqli, $quantity, $productId, $idUser) { //editar
        $sql = "CALL SP_ActuaizarCantidadCarrito(?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("iii", $quantity,  $productId, $idUser);
        $stmt->execute();
        
        // Obtener el mensaje devuelto por el procedimiento almacenado
        $stmt->next_result(); // Mover al siguiente conjunto de resultados
        $result = $stmt->get_result(); 
        $mensaje = $result->fetch_assoc();

        // Cerrar el statement
        $stmt->close();

        return $mensaje;
    }


    public function saveVideo($mysqli, $idProducto, $ruta_completa) {
        $sql = "CALL SP_GuardarVideo(?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("is", $idProducto, $ruta_completa);
        $stmt->execute();
    }

    public function lastIdProduct($mysqli) {
        $sql = "CALL SP_UltimoIdProducto()";
        $stmt= $mysqli->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result(); 
        $idProducto = $result->fetch_assoc();
        return $idProducto;

    }

    public static function TraerInfoProductoMensajes($mysqli, $idChat) {
        $sql = "CALL SP_TraerInfoProductoMensajes(?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("i", $idChat);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $producto = $result->fetch_assoc();
        return $producto;

    }

    public static function ProductosMismoVendedor($mysqli, $idProducto) {
        $sql = "CALL SP_ProductosMismoVendedor(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    

    public static function ProductosMismaCategoria($mysqli, $idCategory) {
        $sql = "CALL SP_ProductosMismaCategoria(?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $idCategory);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public static function TraerProductosCarrito($mysqli, $idChat) {
        $sql = "CALL SP_TraerInfoProductoMensajes(?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("i", $idChat);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $producto = $result->fetch_assoc();
        return $producto;

    }


    


    public static function ConsultaCompras($mysqli, $idUser, $fechaInicio, $fechaFin, $categoria) {
        $sql = "CALL SP_ConsultaPedidos(?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("isss", $idUser, $fechaInicio, $fechaFin, $categoria);
        $stmt->execute();
        
        
        $result = $stmt->get_result(); 
        $wishlists = []; // Inicializar un array para almacenar las listas de deseos
    
        // Iterar sobre cada fila de resultados y almacenarla en el array
        while ($row = $result->fetch_assoc()) {
            $wishlists[] = $row;
        }
    
        return $wishlists;


    }



    public static function ConsultaVentasDetallada($mysqli, $idUser, $fechaInicio, $fechaFin, $categoria) {
        $sql = "CALL SP_ConsultaDetalladaVentas (?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("isss", $idUser, $fechaInicio, $fechaFin, $categoria);
        $stmt->execute();
        
        
        $result = $stmt->get_result(); 
        $wishlists = []; // Inicializar un array para almacenar las listas de deseos
    
        // Iterar sobre cada fila de resultados y almacenarla en el array
        while ($row = $result->fetch_assoc()) {
            $wishlists[] = $row;
        }
    
        return $wishlists;


    }


    public static function ConsultaVentasAgrupadas($mysqli, $idUser, $mesInicio, $anioInicio, $categoria) {
        $sql = "CALL ConsultaAgrupada(?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("sssi", $mesInicio, $anioInicio, $categoria, $idUser);
        $stmt->execute();
        
        
        $result = $stmt->get_result(); 
        $wishlists = []; // Inicializar un array para almacenar las listas de deseos
    
        // Iterar sobre cada fila de resultados y almacenarla en el array
        while ($row = $result->fetch_assoc()) {
            $wishlists[] = $row;
        }
    
        return $wishlists;


    }


    public static function  MisProductos($mysqli, $idUser, $categoria,) {
        $sql = "CALL MisProductos (?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("si", $categoria, $idUser);
        $stmt->execute();
        
        
        $result = $stmt->get_result(); 
        $wishlists = []; // Inicializar un array para almacenar las listas de deseos
    
        // Iterar sobre cada fila de resultados y almacenarla en el array
        while ($row = $result->fetch_assoc()) {
            $wishlists[] = $row;
        }
    
        return $wishlists;


    }



    public function EncontrarIdProducto($mysqli, $idProducto, $idUser) {
        $sql = "CALL SP_EncontrarIdProducto(?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("ii", $idProducto, $idUser);
        $stmt->execute();
    }

    public function AgregarAlCarritoLP($mysqli, $idProducto, $idUser) {
        $sql = "CALL SP_AgregarAlCarrito(?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("iii", $idProducto, $idUser, $this->quantityAvailable);
        $stmt->execute();
    }


    public static function MostrarDetalleProducto($mysqli, $idProducto) {
        $sql = "CALL SP_MostrarDetalleProducto(?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $producto = $result->fetch_assoc();
        return $producto;

    }

    

    public function EnviarCotizacion($mysqli, $idChat, $idUser) {
        $sql = "CALL SP_EnviarCotizacion(?,?,?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("sdii", $this->specifications, $this->priceAgreed, $idChat, $idUser);
        $stmt->execute();
        $this->id = (int)$stmt->insert_id;
    }

    public static function AceptarCotizacion($mysqli, $idChat, $idUser) {
        $sql = "CALL SP_AceptarCotizacion(?,?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("ii", $idChat, $idUser);
        $stmt->execute();
        
        $result = $stmt->get_result(); 
        $idProducto = $result->fetch_assoc();
        return $idProducto;
    }


    public static function TraerCotizacion($mysqli, $idChat) {
        $sql = "CALL SP_TraerCotizacion(?)";
        $stmt= $mysqli->prepare($sql);
        $stmt->bind_param("i", $idChat);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $producto = $result->fetch_assoc();
        return $producto;
    }

}

?>
