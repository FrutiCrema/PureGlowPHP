CREATE DATABASE DB_PureGlow;
USE DB_PureGlow;


CREATE TABLE `TB_User`(
    `user_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_email`        VARCHAR(60) NOT NULL UNIQUE,
    `user_userName`     VARCHAR(60) NOT NULL UNIQUE,
    `user_password`     VARCHAR(255) NOT NULL,
    `user_name`         VARCHAR(60) NOT NULL,
    `user_birthDate`    DATE NOT NULL,
    `user_image`        LONGBLOB NOT NULL,
    `user_gender`       VARCHAR(60) NOT NULL,
    `user_lastDate`     DATETIME NOT NULL DEFAULT NOW(),
    `user_isPublic`     TINYINT NOT NULL,
    `user_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `user_rol`          INT NOT NULL
);



INSERT INTO `DB_PureGlow`.`TB_User`(`user_email`, `user_userName`, `user_password`, `user_name`,  `user_birthDate`, `user_image`,
`user_gender`, `user_isPublic`,  `user_rol`)
    VALUES ('coquitos@hotmail.com',  'Coquitos',  'Coquitos22@',  'Coquitos Gonzales',  '2000-02-02',  'efsfsdsffd',  'Femenino',  1,  1);

CREATE TABLE `TB_Product`(
    `producto_id`                INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `producto_name`              VARCHAR(60) NOT NULL,
    `producto_description`       TEXT NOT NULL,
    `producto_isApproved`        TINYINT NOT NULL DEFAULT 0,
    `producto_quotation`         TINYINT NOT NULL,
    `producto_price`             DECIMAL,
    `producto_quantityAvailable` INT,
    `producto_isEnable`          TINYINT NOT NULL DEFAULT 1,
    `producto_createdAt`         DATETIME NOT NULL DEFAULT NOW(),
    `producto_idUser`            INT NOT NULL,
    `producto_idAdmin`           INT NOT NULL DEFAULT 0,
    FOREIGN KEY (`producto_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`),
    FOREIGN KEY (`producto_idAdmin`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);


CREATE TABLE `TB_Image`(
    `imagen_id`             INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `imagen_content`        LONGBLOB NOT NULL,
    `imagen_isInUse`        TINYINT NOT NULL DEFAULT 1,
    `imagen_idProducto`     INT NOT NULL,
    FOREIGN KEY (`imagen_idProducto`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);


CREATE TABLE `TB_Video`(
    `video_id`              INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `video_content`         LONGBLOB NOT NULL,
    `imagen_isInUse`        TINYINT NOT NULL DEFAULT 1,
    `video_idProducto`      INT NOT NULL,
    FOREIGN KEY (`video_idProducto`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);


CREATE TABLE `TB_Quotation`(
    `quotation_id`              INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `quotation_specifications`  TEXT NOT NULL,
    `quotation_priceAgreed`     DECIMAL(10, 10),
    `quotation_isEnable`        TINYINT NOT NULL DEFAULT 1,
    `quotation_idProduct`       INT NOT NULL,
    `quotation_idUser`          INT NOT NULL,
    FOREIGN KEY (`quotation_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`quotation_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `TB_Wishlist`(
    `lista_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `lista_name`         VARCHAR(60) NOT NULL,
    `lista_description`  TEXT NOT NULL,
    `lista_isPublic`     TINYINT NOT NULL,
    `lista_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `lista_idUser`       INT NOT NULL,
    FOREIGN KEY (`lista_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);


CREATE TABLE `TB_ProductWishlist`(
    `listaProducto_id`         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `listaProducto_idLista`      INT NOT NULL,
    `listaProducto_idProducto`   INT NOT NULL,
    FOREIGN KEY (`listaProducto_idLista`) REFERENCES `DB_PureGlow`.`TB_Wishlist`(`lista_id`),
    FOREIGN KEY (`listaProducto_idProducto`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);


CREATE TABLE `TB_Category`(
    `category_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `category_name`         VARCHAR(60) NOT NULL,
    `category_description`  TEXT NOT NULL,
    `category_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `category_idUser`         INT NOT NULL,
    FOREIGN KEY (`category_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `TB_CategoryProduct`(
    `categoryProduct_id`        INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `categoryProduct_idProduct`   INT NOT NULL,
    `categoryProduct_idCategory`  INT NOT NULL,
    FOREIGN KEY (`categoryProduct_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`categoryProduct_idCategory`) REFERENCES `DB_PureGlow`.`TB_Category`(`category_id`)
);


CREATE TABLE `Rating`(
    `rating_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `rating_score`        INT NOT NULL,
    `rating_comment`      TEXT,
    `rating_idProduct`    INT NOT NULL,
    `rating_idUser`       INT NOT NULL,
    FOREIGN KEY (`rating_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`rating_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `TB_Cart`(
    `carrito_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `carrito_createdAt`    DATETIME NOT NULL DEFAULT NOW(),
    `carrito_isDefault`    TINYINT NOT NULL DEFAULT 0,
    `carrito_idUser`       INT NOT NULL,
    FOREIGN KEY (`carrito_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);


CREATE TABLE `TB_CartItem`(
    `cartItem_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `cartItem_quantity` INT NOT NULL,
    `cartItem_idProduct`  INT NOT NULL,
    `cartItem_idCart`     INT NOT NULL,
    FOREIGN KEY (`cartItem_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`cartItem_idCart`) REFERENCES `DB_PureGlow`.`TB_Cart`(`carrito_id`)
);

CREATE TABLE `TB_Chat`(
    `conversacion_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `conversacion_idSeller`   INT NOT NULL,
    `conversacion_idBuyer`    INT NOT NULL,
    `conversacion_idProduct`  INT NOT NULL,
    FOREIGN KEY (`conversacion_idSeller`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`),
    FOREIGN KEY (`conversacion_idBuyer`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`),
    FOREIGN KEY (`conversacion_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);

CREATE TABLE `TB_Message`(
    `mensaje_id`            INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `mensaje_text`          TEXT NOT NULL,
    `mensaje_date`          DATETIME NOT NULL DEFAULT NOW(),
    `mensaje_idChat`        INT NOT NULL,
    `mensaje_idSender`      INT NOT NULL,
    FOREIGN KEY (`mensaje_idChat`) REFERENCES `DB_PureGlow`.`TB_Chat`(`conversacion_id`),
    FOREIGN KEY (`mensaje_idSender`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);


CREATE TABLE `TB_Sale`(
    `venta_id`          INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `venta_date`        DATETIME NOT NULL DEFAULT NOW(),
    `venta_idProduct`   INT NOT NULL,
    `venta_idSeller`    INT NOT NULL,
    FOREIGN KEY (`venta_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`venta_idSeller`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);


CREATE TABLE `TB_Purchase`(
    `compra_id`         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `compra_date`       DATETIME NOT NULL DEFAULT NOW(),
    `compra_idProduct`  INT NOT NULL,
    `compra_idBuyer`    INT NOT NULL,
    FOREIGN KEY (`compra_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`compra_idBuyer`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);





/*--------------STORED PROCEDURES USER---------------------*/
DROP PROCEDURE IF EXISTS `SP_insertUser`;
DELIMITER $$

CREATE PROCEDURE `SP_insertUser`(
    IN _email           VARCHAR(60),
    IN _username        VARCHAR(60),
    IN _password        VARCHAR(255),
    IN _name            VARCHAR(60),
    IN _lastName        VARCHAR(60),
    IN _birthdate       DATE,
    IN _image           LONGBLOB,
    IN _gender          VARCHAR(60),
    IN _isPublic        TINYINT,
    IN _rol             VARCHAR(60)       
)
BEGIN
    INSERT INTO `DB_PureGlow`.`TB_User`(`user_email`, `user_userName`, `user_password`, `user_name`, `user_lastName`, `user_birthDate`, `user_image`, 
    `user_gender`, `user_isPublic`, `user_rol`)
    VALUES(_email, _username, _password, _name, _lastName, _birthdate, _image, _gender, _isPublic, _rol);
    INSERT INTO `Cosmeticos`.`Carrito`(`carrito_user`)VALUES(LAST_INSERT_ID());
END $$
DELIMITER ;



CREATE PROCEDURE `SP_login`(
    IN _username VARCHAR(50),
    IN _password VARCHAR(50)
)
BEGIN
    SELECT `user_id`, `user_email`, `user_userName`, ``
    FROM TB_User
    WHERE (`user_userName` = _username OR `user_email` = _username) AND `user_password` = _password
    LIMIT 1;
END $$
DELIMITER ;



CREATE PROCEDURE `SP_Signup`(
    IN _email           VARCHAR(50),
    IN _usernanme       VARCHAR(50),
    IN _password        VARCHAR(50),
    IN _role            VARCHAR(50),
    IN _image           LONGBLOB,
    IN _namefull        VARCHAR(50),
    IN _birthdate       DATE,
    IN _gender          VARCHAR(50),
    IN _visibility      VARCHAR(50)
)
BEGIN
    INSERT INTO TB_User (`user_email`, `user_userName`, `user_password`, `user_rol`, `user_image`, `user_name`, `user_birthDate`, `user_gender`, `user_isPublic`)
    VALUES (_email, _usernanme, _password, _role, _image, _namefull, _birthdate, _gender, _visibility);
END $$

DELIMITER ;



CREATE PROCEDURE `SP_FoudIdUser`(
    IN _idUser INT,
)
BEGIN
    SELECT `user_id`, `user_userName`,
    FROM TB_User
    WHERE `user_id` = _idUser;
END $$
DELIMITER ;




BEGIN
    INSERT INTO TB_User (`user_email`, `user_userName`, `user_password`, `user_rol`, `user_image`, `user_name`, `user_birthDate`, `user_gender`, `user_isPublic`)
    VALUES (_email, _usernanme, _password, _role, _image, _namefull, _birthdate, _gender, _visibility);
END


CREATE PROCEDURE `SP_EncontrarIdUsuario`(
    IN _username VARCHAR(50),
)
BEGIN
    SELECT `user_rol`
    FROM TB_User
    WHERE `user_userName` = _username
END $$
DELIMITER ;


CREATE PROCEDURE `SP_EncontrarUsername`(
    IN _username VARCHAR(50),
)
BEGIN
    SELECT `user_email`, `user_userName`, `user_password`, `user_name`, `user_birthDate`, `user_image`, `user_gender`, `user_isPublic`, `user_rol` 
    FROM TB_User
    WHERE `user_userName` = _username
END $$
DELIMITER ;



DELIMITER $$
CREATE PROCEDURE `SP_ModificarUsuario`(
    IN p_username VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_password VARCHAR(100),
    IN p_name VARCHAR(100),
    IN p_birthDate DATE,
    IN p_image VARCHAR(255),
    IN p_gender VARCHAR(10)
)
BEGIN
    UPDATE TB_User 
    SET 
        user_userName = p_username,
        user_email = p_email,
        user_password = p_password,
        user_name = p_name,
        user_birthDate = p_birthDate,
        user_image = p_image,
        user_gender = p_gender
    WHERE user_userName = p_username;
END $$
DELIMITER ;



BEGIN
    INSERT INTO TB_User (`user_email`, `user_userName`, `user_password`, `user_rol`, `user_image`, `user_name`, `user_birthDate`, `user_gender`, `user_isPublic`)
    VALUES (_email, _usernanme, _password, _role, _image, _namefull, _birthdate, _gender, _visibility);
END


producto_id Primaria	int(11)
producto_name	varchar(60)
producto_description	text
producto_isApproved	tinyint(4)
producto_quotation	tinyint(4)
producto_price	decimal(10,2)	
producto_quantityAvailable	int(11)
producto_isEnable	tinyint(4)	
producto_createdAt	datetime
producto_idUser Índice	int(11)
producto_idAdmin Índice	int(11)



CREATE PROCEDURE `SP_NuevoProducto` (
    IN `_name` VARCHAR(200),
    IN `_description` TEXT,
    IN `_quotation` TINYINT(4),
    IN `_price` DECIMAL(10,2),
    IN `_quantityAvailable` INT(9999),
    IN `_idUser` INT(200)
)

BEGIN
    INSERT INTO tb_product (`producto_name`, `producto_description`, `producto_quotation`, `producto_price`, `producto_quantityAvailable`, `producto_idUser`)
    VALUES (_name, _description, _quotation, _price, _quantityAvailable, _idUser);
END



CREATE PROCEDURE `SP_NuevaCategoria` (
    IN `_name` VARCHAR(200),
    IN `_description` TEXT,
    IN `_idUser` INT(200)
)

BEGIN
    INSERT INTO TB_Category (`category_name`, `category_description`, `category_idUser`)
    VALUES (_name, _description, _idUser);
END







CREATE PROCEDURE `SP_EncontrarIdProducto` (
    IN `_idProducto` INT(200)
)

BEGIN
    UPDATE tb_product SET 'producto_isApproved' = 1
    WHERE 'producto_id' = _idProducto
    
END




CREATE PROCEDURE `SP_AgregarAlCarritoLP` (
    IN `_idProducto` INT(200),
    IN `_idUser` INT(200)
)

BEGIN
    DECLARE _esCotizable INT
    DECLARE _idDefault INT
    DECLARE _idCarrito INT
    DECLARE _idVendedor INT
    DECLARE _idChat INT

    SELECT 'producto_quotation' INTO _esCotizable FROM tb_product WHERE 'producto_id' = _idProducto;

    IF(_esCotizable == 1)
    {
        IF SELECT 'carrito_id' FROM TB_Cart WHERE 'carrito_idUser' = `_idUser`
        {
            SELECT 'carrito_isDefault' INTO _idDefault, 'carrito_id' INTO _idCarrito FROM TB_Cart WHERE 'carrito_idUser' = `_idUser`;

            IF(_idDefault == 1)
            {
                IF SELECT 'cartItem_idProduct' FROM TB_CartItem WHERE 'cartItem_idCart' = _idCarrito
                {
                    UPDATE TB_CartItem SET 'cartItem_quantity' = 'cartItem_quantity' + 1 WHERE 'cartItem_idProduct' = _idProducto
                } 

                ELSE
                {
                    INSERT INTO TB_CartItem (`cartItem_quantity`, `cartItem_idProduct `, `cartItem_idCart `)
                    VALUES (1, _idProducto, _idCarrito);
                }
            }
            ELSE
            {
                -- Insertar en la tabla tb_cart y obtener el ID generado
                UPDATE tb_cart SET 'carrito_isDefault' = 1 WHERE 'carrito_idUser'= _idUser;

                SELECT 'carrito_id' INTO _idCarrito FROM TB_Cart WHERE 'carrito_idUser'= _idUser;

                -- Insertar en la tabla TB_CartItem utilizando el ID del carrito recién insertado
                INSERT INTO TB_CartItem (cartItem_quantity, cartItem_idProduct, cartItem_idCart)
                VALUES (1, _idProducto, _idCarrito);
            }
        }

        ELSE
        {
            -- Insertar en la tabla tb_cart y obtener el ID generado
            INSERT INTO tb_cart (carrito_isDefault, carrito_idUser)
            VALUES (1, _idUser);

            SET _idCarrito = SCOPE_IDENTITY(); -- Obtener el último ID insertado

            -- Insertar en la tabla TB_CartItem utilizando el ID del carrito recién insertado
            INSERT INTO TB_CartItem (cartItem_quantity, cartItem_idProduct, cartItem_idCart)
            VALUES (1, _idProducto, _idCarrito);
        }
    }

    ELSE
    {
        SELECT 'producto_idUser' INTO _idVendedor FROM tb_product WHERE 'producto_id' = _idProducto;

        IF SELECT 'conversacion_id' FROM TB_Chat WHERE 'conversacion_idSeller' = _idVendedor AND 'conversacion_idBuyer' = _idUser AND 'conversacion_idProduct' = _idProducto;
        {
            SELECT 'conversacion_id' INTO _idChat FROM TB_Chat WHERE 'conversacion_idSeller' = _idVendedor AND 'conversacion_idBuyer' = _idUser AND 'conversacion_idProduct' = _idProducto;

            INSERT INTO TB_Message ('mensaje_text', 'mensaje_idChat ', 'mensaje_idSender')
            VALUES ('El usuario sigue interezado en cotizar el producto', _idChat, _idUser);
        }
        ELSE
        {
            INSERT INTO TB_Chat ('conversacion_idSeller ', 'conversacion_idBuyer ', 'conversacion_idProduct ')
            VALUES (_idVendedor, _idUser, _idProducto);

            SET _idChat = SCOPE_IDENTITY();
        
            INSERT INTO TB_Message ('mensaje_text', 'mensaje_idChat ', 'mensaje_idSender')
            VALUES ('El usuario quiere cotizar el producto', _idChat, _idUser);
        }
    }
    
END









CREATE PROCEDURE `SP_MostrarDetalleProducto` (
    IN `_idProducto` INT(200)
)

BEGIN
    SELECT p.'producto_id', p.'producto_name', p.'producto_description', p.'producto_quotation', p.'producto_price', p.'producto_quantityAvailable', c.'category_name' FROM tb_product p
    WHERE p.'producto_id' = _idProducto


    JOIN TB_CategoryProduct cp ON cp.categoryProduct_idProduct = p.producto_id;
    JOIN tb_category c ON c.category_id = cp.categoryProduct_idCategory;

    
END



CREATE PROCEDURE `SP_MostrarDetalleProducto` (
    IN `_idProducto` INT(200)
)

BEGIN
    SELECT 'producto_id', 'producto_name', 'producto_description', 'producto_quotation', 'producto_price', 'producto_quantityAvailable' FROM tb_product 
    WHERE 'producto_id' = _idProducto;   
END










BEGIN
    DECLARE _product_id INT;
    DECLARE _category_id INT;

    -- Insertar el producto y guardar su ID
    INSERT INTO tb_product (producto_name, producto_description, producto_quotation, producto_price, producto_quantityAvailable, producto_idUser)
    VALUES (_name, _description, _quotation, _price, _quantityAvailable, _idUser);

    SET _product_id = LAST_INSERT_ID();

    -- Buscar el ID de la categoría
    SELECT category_id INTO _category_id FROM tb_category WHERE category_name = _category;

    -- Insertar en tb_categoryproduct
    INSERT INTO tb_categoryproduct (categoryProduct_idProduct, categoryProduct_idCategory) VALUES (_product_id, _category_id);
END


DELIMITER //

CREATE PROCEDURE `SP_AgregarAlCarritoLP` (
    IN `_idProducto` INT(200),
    IN `_idUser` INT(200)
)
BEGIN
    DECLARE _esCotizable INT;
    DECLARE _idDefault INT;
    DECLARE _idCarrito INT;
    DECLARE _idVendedor INT;
    DECLARE _idChat INT;

    SELECT producto_quotation INTO _esCotizable FROM tb_product WHERE producto_id = _idProducto;

    IF (_esCotizable = 1) THEN
        IF EXISTS (SELECT carrito_id FROM TB_Cart WHERE carrito_idUser = _idUser) THEN
            SELECT carrito_isDefault, carrito_id INTO _idDefault, _idCarrito FROM TB_Cart WHERE carrito_idUser = _idUser;

            IF (_idDefault = 1) THEN
                IF EXISTS (SELECT cartItem_idProduct FROM TB_CartItem WHERE cartItem_idCart = _idCarrito AND cartItem_idProduct = _idProducto) THEN
                    UPDATE TB_CartItem SET cartItem_quantity = cartItem_quantity + 1 WHERE cartItem_idProduct = _idProducto;
                ELSE
                    INSERT INTO TB_CartItem (cartItem_quantity, cartItem_idProduct, cartItem_idCart)
                    VALUES (1, _idProducto, _idCarrito);
                END IF;
            ELSE
                UPDATE TB_Cart SET carrito_isDefault = 1 WHERE carrito_idUser = _idUser;

                SELECT carrito_id INTO _idCarrito FROM TB_Cart WHERE carrito_idUser = _idUser;

                INSERT INTO TB_CartItem (cartItem_quantity, cartItem_idProduct, cartItem_idCart)
                VALUES (1, _idProducto, _idCarrito);
            END IF;
        ELSE
            INSERT INTO TB_Cart (carrito_isDefault, carrito_idUser)
            VALUES (1, _idUser);

            SET _idCarrito = LAST_INSERT_ID();

            INSERT INTO TB_CartItem (cartItem_quantity, cartItem_idProduct, cartItem_idCart)
            VALUES (1, _idProducto, _idCarrito);
        END IF;
    ELSE
        SELECT producto_idUser INTO _idVendedor FROM tb_product WHERE producto_id = _idProducto;

        IF EXISTS (SELECT conversacion_id FROM TB_Chat WHERE conversacion_idSeller = _idVendedor AND conversacion_idBuyer = _idUser AND conversacion_idProduct = _idProducto) THEN
            SELECT conversacion_id INTO _idChat FROM TB_Chat WHERE conversacion_idSeller = _idVendedor AND conversacion_idBuyer = _idUser AND conversacion_idProduct = _idProducto;

            INSERT INTO TB_Message (mensaje_text, mensaje_idChat, mensaje_idSender)
            VALUES ('El usuario sigue interesado en cotizar el producto', _idChat, _idUser);
        ELSE
            INSERT INTO TB_Chat (conversacion_idSeller, conversacion_idBuyer, conversacion_idProduct)
            VALUES (_idVendedor, _idUser, _idProducto);

            SET _idChat = LAST_INSERT_ID();
        
            INSERT INTO TB_Message (mensaje_text, mensaje_idChat, mensaje_idSender)
            VALUES ('El usuario quiere cotizar el producto', _idChat, _idUser);
        END IF;
    END IF;
END //

DELIMITER ;




-- TRIGGER

DELIMITER //
CREATE TRIGGER TG_CategoriaRepetida BEFORE INSERT ON tb_category
FOR EACH ROW
BEGIN
    DECLARE num_rows INT;
    DECLARE lower_case_name VARCHAR(255);
    
    -- Convertir el nombre de la categoría a minúsculas
    SET lower_case_name = LOWER(NEW.category_name);
    
    -- Contar las filas donde el nombre de la categoría (en minúsculas) coincide con el nuevo valor
    SELECT COUNT(category_name) INTO num_rows FROM tb_category WHERE LOWER(category_name) = lower_case_name;
    
    IF num_rows > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: La categoría ya existe en la tabla.';
    END IF;
END;
//
DELIMITER ;










 SELECT 
    `p`.`producto_name` AS Nombre,
    `p`.`producto_description` AS Descripción,
    `p`.`producto_quotation` AS Es_cotizable,
    `p`.`producto_price` AS Precio,
    `p`.`producto_quantityAvailable` AS Cantidad_disponible,
    `p`.`producto_id` AS IdP,
    `u`.`user_userName` AS Usuario,
    `c`.`category_name` AS Categoría,
    (
        SELECT `i`.`imagen_content`
        FROM `db_pureglow`.`tb_image` `i`
        WHERE `i`.`imagen_idProducto` = `p`.`producto_id`
        LIMIT 1
    ) AS Contenido_imagen
FROM 
    `db_pureglow`.`tb_product` `p`
    JOIN `db_pureglow`.`tb_user` `u` ON `p`.`producto_idUser` = `u`.`user_id`
    JOIN `db_pureglow`.`tb_categoryproduct` `cp` ON `p`.`producto_id` = `cp`.`categoryProduct_idProduct`
    JOIN `db_pureglow`.`tb_category` `c` ON `cp`.`categoryProduct_idCategory` = `c`.`category_id`
WHERE 
    `p`.`producto_isApproved` = 0;