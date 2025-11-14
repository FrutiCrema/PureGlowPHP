CREATE DATABASE DB_PureGlow;
USE DB_PureGlow;



CREATE TABLE `DB_PureGlow`.`TB_User`(
    `user_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_email`        VARCHAR(60) NOT NULL UNIQUE,
    `user_userName`     VARCHAR(60) NOT NULL UNIQUE,
    `user_password`     VARCHAR(255) NOT NULL,
    `user_name`         VARCHAR(60) NOT NULL,
    `user_lastName`     VARCHAR(60) NOT NULL,
    `user_birthDate`    DATE NOT NULL,
    `user_image`        LONGBLOB NOT NULL,
    `user_gender`       VARCHAR(60) NOT NULL,
    `user_lastDate`     DATETIME NOT NULL DEFAULT NOW(),
    `user_isPublic`     TINYINT NOT NULL,
    `user_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `user_rol`          INT NOT NULL,
);


CREATE TABLE `DB_PureGlow`.`TB_Product`(
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
    FOREIGN KEY (`producto_idAdmin`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`),
);


CREATE TABLE `DB_PureGlow`.`TB_Image`(
    `imagen_id`             INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `imagen_content`        LONGBLOB NOT NULL,
    `imagen_isInUse`        TINYINT NOT NULL DEFAULT 1,
    `imagen_idProducto`     INT NOT NULL,
    FOREIGN KEY (`imagen_idProducto`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Video`(
    `video_id`              INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `video_content`         LONGBLOB NOT NULL,
    `imagen_isInUse`        TINYINT NOT NULL DEFAULT 1,
    `video_idProducto`      INT NOT NULL,
    FOREIGN KEY (`video_idProducto`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Quotation`(
    `quotation_id`              INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `quotation_specifications`  TEXT NOT NULL,
    `quotation_priceAgreed`     DECIMAL(10, 10),
    `quotation_isEnable`        TINYINT NOT NULL DEFAULT 1,
    `quotation_idProduct`       INT NOT NULL,
    `quotation_idUser`          INT NOT NULL,
    FOREIGN KEY (`quotation_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`quotation_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Wishlist`(
    `lista_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `lista_name`         VARCHAR(60) NOT NULL,
    `lista_description`  TEXT NOT NULL,
    `lista_isPublic`     TINYINT NOT NULL,
    `lista_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `lista_idUser`       INT NOT NULL,
    FOREIGN KEY (`lista_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);


CREATE TABLE `DB_PureGlow`.`TB_ProductWishlist`(
    `listaProducto_id`         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `listaProducto_idLista`      INT NOT NULL,
    `listaProducto_idProducto`   INT NOT NULL,
    FOREIGN KEY (`listaProducto_idLista`) REFERENCES `DB_PureGlow`.`TB_Wishlist`(`lista_id`),
    FOREIGN KEY (`listaProducto_idProducto`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Category`(
    `category_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `category_name`         VARCHAR(60) NOT NULL,
    `category_description`  TEXT NOT NULL,
    `category_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `category_idUser`         INT NOT NULL,
    FOREIGN KEY (`category_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_CategoryProduct`(
    `categoryProduct_id`        INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `categoryProduct_idProduct`   INT NOT NULL,
    `categoryProduct_idCategory`  INT NOT NULL,
    FOREIGN KEY (`categoryProduct_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`categoryProduct_idCategory`) REFERENCES `DB_PureGlow`.`TB_Category`(`category_id`)
);

CREATE TABLE `DB_PureGlow`.`Rating`(
    `rating_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `rating_score`        INT NOT NULL,
    `rating_comment`      TEXT,
    `rating_idProduct`    INT NOT NULL,
    `rating_idUser`       INT NOT NULL,
    FOREIGN KEY (`rating_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`rating_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Cart`(
    `carrito_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `carrito_createdAt`    DATETIME NOT NULL DEFAULT NOW(),
    `carrito_isDefault`    TINYINT NOT NULL DEFAULT 0,
    `carrito_idUser`       INT NOT NULL,
    FOREIGN KEY (`carrito_idUser`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_CartItem`(
    `cartItem_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `cartItem_quantity` INT NOT NULL,
    `cartItem_idProduct`  INT NOT NULL,
    `cartItem_idCart`     INT NOT NULL,
    FOREIGN KEY (`cartItem_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`cartItem_idCart`) REFERENCES `DB_PureGlow`.`TB_Cart`(`carrito_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Chat`(
    `conversacion_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `conversacion_idSeller`   INT NOT NULL,
    `conversacion_idBuyer`    INT NOT NULL,
    `conversacion_idProduct`  INT NOT NULL,
    FOREIGN KEY (`conversacion_idSeller`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`),
    FOREIGN KEY (`conversacion_idBuyer`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`),
    FOREIGN KEY (`conversacion_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Message`(
    `mensaje_id`            INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `mensaje_text`          TEXT NOT NULL,
    `mensaje_date`          DATETIME NOT NULL DEFAULT NOW(),
    `mensaje_idChat`        INT NOT NULL,
    `mensaje_idSender`      INT NOT NULL,
    FOREIGN KEY (`mensaje_idChat`) REFERENCES `DB_PureGlow`.`TB_Chat`(`conversacion_id`),
    FOREIGN KEY (`mensaje_idSender`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Sale`(
    `venta_id`          INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `venta_date`        DATETIME NOT NULL DEFAULT NOW(),
    `venta_idProduct`   INT NOT NULL,
    `venta_idSeller`    INT NOT NULL,
    FOREIGN KEY (`venta_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`venta_idSeller`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

CREATE TABLE `DB_PureGlow`.`TB_Purchase`(
    `compra_id`         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `compra_date`       DATETIME NOT NULL DEFAULT NOW(),
    `compra_idProduct`  INT NOT NULL,
    `compra_idBuyer`    INT NOT NULL,
    FOREIGN KEY (`compra_idProduct`) REFERENCES `DB_PureGlow`.`TB_Product`(`producto_id`),
    FOREIGN KEY (`compra_idBuyer`) REFERENCES `DB_PureGlow`.`TB_User`(`user_id`)
);

/*---------------VIEWS------------------------------------*/

CREATE VIEW userInfoView AS
SELECT
    `user_id`,       
    `user_email`,    
    `user_userName`, 
    `user_password`, 
    `user_name`,     
    `user_lastName`, 
    `user_birthDate`,
    `user_image`,    
    `user_gender`,
    `user_isPublic`, 
    `user_isEnable`, 
    `user_rol`
FROM  `Cosmeticos`.`Usuario` ;

CREATE VIEW ProductoEspecificoInfo AS
SELECT 
    p.`producto_id`,
    p.`producto_name`,
    p.`producto_description`,
    p.`producto_image`,
    p.`producto_quotation`,
    p.`producto_price`,
    p.`producto_quantityAvailable`,
    p.`producto_isEnable`,
    u.`user_id`,
    u.`user_userName`,
    u.`user_isPublic`,
    i.`image_content`,
    v.`video_content`
FROM 
    `Cosmeticos`.`Producto` p
LEFT JOIN 
    `Cosmeticos`.`Imagen` i ON p.`producto_id` = i.`image_producto`
LEFT JOIN 
    `Cosmeticos`.`Video` v ON p.`producto_id` = v.`video_producto`
INNER JOIN 
    `Cosmeticos`.`Usuario` u ON p.`producto_user` = u.`user_id`;

CREATE VIEW ProductoGeneralInfo AS
    SELECT
        p.`producto_id`,
        p.`producto_name`,
        p.`producto_quotation`,
        p.`producto_image`,
        p.`producto_price`,
        u.`user_id`,
        u.`user_userName`
    FROM 
        `Cosmeticos`.`Producto` p
    JOIN
        `Cosmeticos`.`Usuario` u ON p.`producto_user` = u.`user_id`;

CREATE VIEW CompleteList AS
    SELECT 
        l.`lista_id`,
        l.`lista_name`,
        l.`lista_description`,
        l.`lista_isPublic`,
        l.`lista_isEnable`,
        u.`user_id`,
        u.`user_userName`,
        u.`user_image`,
        p.`producto_id`,   
        p.`producto_name`,
        p.`producto_image`,
        il.`imagenLista_content`
    FROM `Cosmeticos`.`List` l
    LEFT JOIN `Cosmeticos`.`Lista_Product` lp ON l.`lista_id` = lp.`listaProducto_lista`
    LEFT JOIN `Cosmeticos`.`imagenLista` il ON l.`lista_id` = il.`imagenLista_list`
    JOIN `Cosmeticos`.`Usuario` u ON l.`lista_id` = u.`user_id`
    JOIN `Cosmeticos`.`Producto` p ON lp.`listaProducto_producto` = p.`producto_id`;




CREATE VIEW ChatMessagesView AS
    SELECT
        m.`mensaje_id`,
        m.`mensaje_text`, 
        m.`mensaje_date`, 
        m.`mensaje_sender`,
        u.`user_id`,
        u.`user_userName`,
        u.`user_image`
    FROM `Cosmeticos`.`Mensaje` m
    INNER JOIN `Cosmeticos`.`Usuario` u ON m.`mensaje_sender` = u.`user_id`;


    CREATE VIEW QuotationViewByBuyer AS
    SELECT 
        q.`quotation_expirationDate`,
        q.`quotation_specifications`,
        q.`quotation_priceAgreed`,
        q.`quotation_isEnable`,
        p.`producto_id`,
        p.`producto_name`,
        p.`producto_image`
    FROM `Cosmeticos`.`Quotation` q
    JOIN `Cosmeticos`.`Producto` p ON q.`quotation_product` = p.`producto_id`;

    CREATE VIEW QuotationViewBySeller AS
    SELECT 
        q.`quotation_expirationDate`,
        q.`quotation_specifications`,
        q.`quotation_priceAgreed`,
        q.`quotation_isEnable`,
        p.`producto_id`,
        p.`producto_name`,
        p.`producto_image`,
        u.`user_id`,
        u.`user_userName`,
        u.`user_image`
    FROM `Cosmeticos`.`Quotation` q
    JOIN `Cosmeticos`.`Producto` p ON q.`quotation_product` = p.`producto_id`
    JOIN `Cosmeticos`.`Usuario` u ON q.`quotation_user` = u.`user_id`
    GROUP BY u.`user_id`, p.`producto_id`;

    CREATE VIEW ProductViewByCategory AS
    SELECT
        p.`producto_id`,
        p.`producto_name`,
        p.`producto_image`
    FROM `Cosmeticos`.`Producto` p
    JOIN `Cosmeticos`.`Category_Product` cp ON p.`producto_id` = cp.`categoryProduct_product`;

/*--------------STORED PROCEDURES USER---------------------*/
DROP PROCEDURE IF EXISTS `insertUser`;
DELIMITER $$
CREATE PROCEDURE `insertUser`(
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
    INSERT INTO `Cosmeticos`.`Usuario`(`user_email`, `user_userName`, `user_password`, `user_name`, 
    `user_lastName`, `user_birthDate`, `user_image`, `user_gender`, `user_isPublic`, `user_rol`      
    )VALUES(_email, _username, _password, _name, _lastName, _birthdate, _image, _gender, _isPublic, _rol);
    INSERT INTO `Cosmeticos`.`Carrito`(`carrito_user`)VALUES(LAST_INSERT_ID());
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `updateUserByUser`;
DELIMITER $$
CREATE PROCEDURE `updateUserByUser`(
    IN _id				INT,
    IN _password        VARCHAR(255),
    IN _name            VARCHAR(60),
    IN _lastName        VARCHAR(60),
    IN _birthdate       DATE,
    IN _image           LONGBLOB,
    IN _gender          VARCHAR(60),
    IN _isPublic        TINYINT  
)
BEGIN
     UPDATE `Cosmeticos`.`Usuario` SET
        `user_password` = COALESCE(NULLIF(_password, ""), `user_password`),
        `user_name` = COALESCE(NULLIF(_name, ""), `user_name`),
        `user_lastName` = COALESCE(NULLIF(_lastName, ""), `user_lastName`),
        `user_birthDate` = COALESCE(NULLIF(_birthdate, NULL), `user_birthDate`),
        `user_image` = COALESCE(NULLIF(_image, ""), `user_image`),
        `user_gender` = COALESCE(NULLIF(_gender, ""), `user_gender`),
        `user_isPublic` = COALESCE(NULLIF(_isPublic, NULL), `user_isPublic`)
    WHERE `user_id`= _id;
END $$
DELIMITER ;

/* #CALL updateUserByUser(1, 'Contraseniax2','Nombre', 'Apellidox2', NULL, NULL, '', 0);*/

DROP PROCEDURE IF EXISTS `updateUserByAdmin`;
DELIMITER $$
CREATE PROCEDURE `updateUserByAdmin`(
    IN _id              INT,
    IN _isEnable        TINYINT     
)
BEGIN
    UPDATE `Cosmeticos`.`Usuario`
        SET        
        `user_isEnable` = CASE
            WHEN _isEnable IS NULL OR _isEnable = '' THEN `user_isEnable`
                ELSE _isEnable
            END
    WHERE `user_id`= _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `selectOneUser`;
DELIMITER $$
CREATE PROCEDURE `selectOneUser`(
    IN _identification   VARCHAR(60)
)
BEGIN
    DECLARE _userCount INT;

    SELECT COUNT(*) INTO _userCount
    FROM `Cosmeticos`.`Usuario`
    WHERE `user_email` = _identification OR `user_userName` = _identification;

    IF _userCount = 1 THEN
        SELECT 
            `user_id`,       
            `user_email`,    
            `user_userName`, 
            `user_password`, 
            `user_name`,     
            `user_lastName`, 
            `user_birthDate`,
            `user_image`,    
            `user_gender`,
            `user_isPublic`, 
            `user_isEnable`, 
            `user_rol`
        FROM  `Cosmeticos`.`Usuario`
        WHERE `user_email` = _identification OR `user_userName` = _identification;
    END IF;    
END $$
DELIMITER ;
/*#CALL selectOneUser('nuevo_usuario');*/

DROP PROCEDURE IF EXISTS `checkOneUserExists`;
DELIMITER $$
CREATE PROCEDURE `checkOneUserExists`(
    IN _identification   VARCHAR(60)
)
BEGIN
    DECLARE _userCount INT;

    SELECT COUNT(*) INTO _userCount
    FROM `Cosmeticos`.`Usuario`
    WHERE `user_email` = _identification OR `user_userName` = _identification;

    IF _userCount = 1 THEN
        SELECT 'ALREADY EXISTS' AS response;
    ELSE
        SELECT 'NOT EXISTS' AS response;
    END IF;    
END $$
DELIMITER ;
/*CALL checkOneUserExists('nuevo_usuario');*/

DROP PROCEDURE IF EXISTS `checkOneUserEnabled`;
DELIMITER $$
CREATE PROCEDURE `checkOneUserEnabled`(
    IN _identification   VARCHAR(60)
)
BEGIN
    DECLARE _userIsEnable TINYINT;

    SELECT `user_isEnable` INTO _userIsEnable
    FROM `Cosmeticos`.`Usuario`
    WHERE `user_email` = _identification OR `user_userName` = _identification;

    IF _userIsEnable = 1 THEN
        SELECT 'ENABLED' AS response;
    ELSE
        SELECT 'DISABLED' AS response;
    END IF;    
END $$
DELIMITER ;

/*CALL checkOneUserEnabled('nuevo_usuario@eample.com');*/

DROP PROCEDURE IF EXISTS `selectAllUser`;
DELIMITER $$
CREATE PROCEDURE `selectAllUser`()
BEGIN
   SELECT 
        `user_id`,       
        `user_email`,    
        `user_userName`, 
        `user_password`, 
        `user_name`,     
        `user_lastName`, 
        `user_birthDate`,
        `user_image`,    
        `user_gender`,
        `user_isPublic`, 
        `user_isEnable`, 
        `user_rol`
    FROM `Cosmeticos`.`Usuario`;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `searchUser`;
DELIMITER $$
CREATE PROCEDURE `searchUser`( 
    IN _search  TEXT
    )
BEGIN
    SELECT
        `user_id`, 
        `user_userName`,
        `user_image`,
        `user_isPublic`,
        `user_rol`
    FROM `Cosmeticos`.`Usuario` WHERE 
    (_search IS NULL OR `user_userName` LIKE CONCAT("%", _search, "%"))
    AND `user_isEnable` = 1;
END $$
DELIMITER ;



/*---------------STORED PROCEDURE PRODUCT----------------------*/
DROP PROCEDURE IF EXISTS `insertProduct`;
DELIMITER $$
CREATE PROCEDURE `insertProduct`( 
    IN _name                VARCHAR(60),
    IN _description         TEXT,
    IN _image               LONGBLOB,
    IN _quotation           TINYINT,
    IN _price               DECIMAL,
    IN _quantityAvailable   INT,
    IN _user                INT)
BEGIN
   INSERT INTO `Cosmeticos`.`Producto`(
        `producto_name`,    
        `producto_description`,
        `producto_image`,
        `producto_quotation`,     
        `producto_price`, 
        `producto_quantityAvailable`,
        `producto_user`
    )VALUES(
        _name,             
        _description,
        _image,
        _quotation,     
        _price,        
        _quantityAvailable,
        _user 
    );
    /*SELECT LAST_INSERT_ID() as `lastID`;*/
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `insertImage`;
DELIMITER $$
CREATE PROCEDURE `insertImage`( 
    IN _image       LONGBLOB,
    IN _product     INT
    )
BEGIN
   INSERT INTO `Cosmeticos`.`Image`(
        `imagen_content`,    
        `imagen_producto`
    )VALUES(
        _image,             
        _product
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `insertVideo`;
DELIMITER $$
CREATE PROCEDURE `insertVideo`( 
    IN _video       LONGBLOB,
    IN _product     INT
    )
BEGIN
   INSERT INTO `Cosmeticos`.`Video`(
        `video_content`,    
        `video_producto`
    )VALUES(
        _video,             
        _product
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyProduct`;
DELIMITER $$
CREATE PROCEDURE `modifyProduct`( 
    IN _name                VARCHAR(60),
    IN _description         TEXT,
    IN _image               LONGBLOB,
    IN _quotation           TINYINT,
    IN _price               DECIMAL,
    IN _quantityAvailable   INT,
    IN _isEnable            TINYINT,
    IN _user                INT
    )
BEGIN
    UPDATE `Cosmeticos`.`Producto` SET
        `producto_name` = COALESCE(NULLIF(_name, ""), `producto_name`),
        `producto_description` = COALESCE(NULLIF(_description, ""), `producto_description`),
        `producto_image` = COALESCE(NULLIF(_image, ""), `producto_image`),
        `producto_quotation` = `producto_quotation`,
        `producto_price` = COALESCE(NULLIF(_price, NULL), `producto_price`),
        `producto_quantityAvailable` = COALESCE(NULLIF(_quantityAvailable, NULL), `producto_quantityAvailable`)
    WHERE `producto_id`= _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `approvedProduct`;
DELIMITER $$
CREATE PROCEDURE `approvedProduct`(
    IN _productId   INT,
    IN _userId      INT
    )
BEGIN    
    INSERT INTO `Cosmeticos`.`adminMoves`(`adminMoves_idUser`, `adminMoves_idProduct`)
    VALUES (_userId, _productId);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `selectOneProduct`;
DELIMITER $$
CREATE PROCEDURE `selectOneProduct`( 
    IN _id       INT
    )
BEGIN
    SELECT * FROM ProductSpecificInfo WHERE `product_id` = _id;
END $$
DELIMITER ;

/*
Select * from Notas where
(_Nota IS NULL OR Nota LIKE CONCAT("%",_Nota,"%")) AND
(_Hashtag IS NULL OR Nota REGEXP CONCAT("#", _Hashtag, "(($)|( ))")) AND
((_FechaInicio IS NULL AND _FechaFinal IS NULL) OR Fecha_Creacion between _FechaInicio AND _FechaFinal) AND
Autor_Nota = id AND Eliminada = 0;
END$$
*/
DROP PROCEDURE IF EXISTS `searchProduct`;
DELIMITER $$
CREATE PROCEDURE `searchProduct`( 
    IN _search  TEXT
    )
BEGIN
    SELECT * FROM ProductGeneralInfo WHERE 
    (_search IS NULL OR `Cosmeticos`.`Producto`.`producto_name` LIKE CONCAT("%", _search, "%"));
END $$
DELIMITER ;

/*-------------------------STORED PROCEDURES QUOTATION---------------------------------------*/
DROP PROCEDURE IF EXISTS `addQuotationBuyerRequest`;
DELIMITER $$
CREATE PROCEDURE `addQuotationBuyerRequest`(    
    IN _specifications  TEXT,
    IN _product         INT,
    IN _user            INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Quotation`(
        `quotation_specifications`,
        `quotation_product`,
        `quotation_user`
    )VALUES(
        _specifications,
        _product,
        _user
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyQuotationSellerResponse`;
DELIMITER $$
CREATE PROCEDURE `modifyQuotationSellerResponse`(
    IN _id              INT,
    IN _expirationDate  DATETIME,    
    IN _priceAgreed     DECIMAL(10,10)
)
BEGIN
    UPDATE `Cosmeticos`.`Quotation` SET
        `quotation_expirationDate` =  COALESCE(NULLIF(_expirationDate, NULL), `quotation_expirationDate`),
        `quotation_priceAgreed` = COALESCE(NULLIF(_priceAgreed, NULL), `quotation_priceAgreed`)
    WHERE `quotation_id` = _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getAllQuotationOneBuyer`;
DELIMITER $$
CREATE PROCEDURE `getAllQuotationOneBuyer`(
    IN _idUser              INT    
)
BEGIN
    SELECT 
        q.`quotation_expirationDate`,
        q.`quotation_specifications`,
        q.`quotation_priceAgreed`,
        q.`quotation_isEnable`,
        p.`product_id`,
        p.`product_name`,
        p.`product_image`
    FROM `Cosmeticos`.`Quotation` q
    JOIN `Cosmeticos`.`Producto` p ON q.`quotation_product` = p.`producto_id`
    WHERE  q.`producto_user` = _idUser;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getAllQuotationOneSeller`;
DELIMITER $$
CREATE PROCEDURE `getAllQuotationOneSeller`(
    IN _idUser              INT    
)
BEGIN
    SELECT 
       q.`quotation_expirationDate`,
       q.`quotation_specifications`,
       q.`quotation_priceAgreed`,
       q.`quotation_isEnable`,
       p.`producto_id`,
       p.`producto_name`,
       p.`producto_image`,
       u.`user_id`,
       u.`user_userName`,
       u.`user_image`
    FROM `Cosmeticos`.`Quotation` q
    JOIN `Cosmeticos`.`Producto` p ON q.`quotation_product` = p.`producto_id`
    JOIN `Cosmeticos`.`User` u ON q.`quotation_user` = u.`user_id`
    WHERE p.`producto_user` = _idUser
    GROUP BY u.`user_id`, p.`producto_id`;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `deleteLogicalQuotation`;
DELIMITER $$
CREATE PROCEDURE `deleteLogicalQuotation`(
    IN _idQuotation             INT    
)
BEGIN
    UPDATE `Cosmeticos`.`Quotation` SET
        `product_isEnable` = 0
    WHERE `producto_id` = _idQuotation;
END $$
DELIMITER ;

/*-----------------------------------STORED PROECURE LIST-----------------------------------*/
DROP PROCEDURE IF EXISTS `addList`;
DELIMITER $$
CREATE PROCEDURE `addList`(
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _isPublic        TINYINT,
    IN _userOwner       INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Lista`(
        `lista_name`, 
        `lista_description`,
        `lista_isPublic`,
        `lista_user`
    )VALUES(
        _name,
        _description,
        _isPublic,
        _userOwner
    );
    /*SELECT LAST_INSERT_ID() as `lastID`;*/
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addImageList`;
DELIMITER $$
CREATE PROCEDURE `addImageList`(
    IN _image       LONGBLOB,
    IN _idList      INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`imagenLista`(
        `imagenLista_content`, 
        `imagenLista_lista`
    )VALUES(
        _image,
        _idList
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addProductToList`;
DELIMITER $$
CREATE PROCEDURE `addProductToList`(
    IN _idList      INT,
    IN _idProduct   INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Lista_Producto`(
        `listaProducto_lista`, 
        `listaProducto_producto`
    )VALUES(
        _idList,
        _idProduct
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyList`;
DELIMITER $$
CREATE PROCEDURE `modifyList`(
    IN _id              INT,
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _isPublic        TINYINT
)
BEGIN
    UPDATE `Cosmeticos`.`Lista` SET
        `lista_name` = COALESCE(NULLIF(_name, ""), `lista_name`),
        `lista_description` = COALESCE(NULLIF(_description, ""), `lista_description`),
        `lista_isPublic` = COALESCE(NULLIF(_isPublic, ""), `lista_isPublic`)
    WHERE `lista_id` = _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getListByName`;
DELIMITER $$
CREATE PROCEDURE `getListByName`(
    IN _name            VARCHAR(60)
)
BEGIN
    SELECT * FROM CompleteList
    WHERE (_name IS NULL OR `Cosmeticos`.`Lista`.`lista_name` LIKE CONCAT("%", _name, "%"))
    AND `Cosmeticos`.`Lista`.`lista_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getListByUser`;
DELIMITER $$
CREATE PROCEDURE `getListByUser`(
    IN _user    INT
)
BEGIN
    SELECT * FROM CompleteList
    WHERE `Cosmeticos`.`Lista`.`lista_user` = _user
    AND `Cosmeticos`.`Lista`.`lista_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `deleteLogicalList`;
DELIMITER $$
CREATE PROCEDURE `deleteLogicalList`(
    IN _id  INT
)
BEGIN
    UPDATE `Cosmeticos`.`Lista` SET
        `lista_isEnable` = 0
    WHERE `lista_id` = _id;
END $$
DELIMITER ;

/*--------------------------STORED PROCEDURE CATEGORY----------------------------------*/
DROP PROCEDURE IF EXISTS `addCategory`;
DELIMITER $$
CREATE PROCEDURE `addCategory`(
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _userOwner       INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Category`(
        `category_name`, 
        `category_description`,
        `category_user`
    )VALUES(
        _name,
        _description,
        _userOwner
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addProductInCategory`;
DELIMITER $$
CREATE PROCEDURE `addProductInCategory`(
    IN _idProduct       INT,
    IN _idCategory       INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Category_Product`(
        `categoryProduct_product`, 
        `categoryProduct_category`
    )VALUES(
        _idProduct,
        _idCategory
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyCategory`;
DELIMITER $$
CREATE PROCEDURE `modifyCategory`(
    IN _id              INT,
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _isEnable        TINYINT
)
BEGIN
    UPDATE `Cosmeticos`.`Category` SET
        `category_name` = COALESCE(NULLIF(_name, ""), `category_name`),
        `category_description` = COALESCE(NULLIF(_description, ""), `category_description`),
        `category_isEnable` = _isEnable
    WHERE `category_id` = _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getAllCategories`;
DELIMITER $$
CREATE PROCEDURE `getAllCategories`(
)
BEGIN
    SELECT 
        `category_id`,
        `category_name`,
        `category_description`
    FROM `Cosmeticos`.`Category`;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getProductByCategory`;
DELIMITER $$
CREATE PROCEDURE `getProductByCategory`(
    IN _idCategory INT
)
BEGIN
    SELECT
        p.`producto_id`,
        p.`producto_name`,
        p.`producto_image`
    FROM `Cosmeticos`.`Producto` p
    JOIN `Cosmeticos`.`Category_Product` cp ON p.`producto_id` = cp.`categoryProduct_product`
    WHERE cp.`categoryProduct_category` = _idCategory;
END $$
DELIMITER ;

/*----------------------------------------STORED PROCEDURE RATING----------------------*/
DROP PROCEDURE IF EXISTS `addRating`;
DELIMITER $$
CREATE PROCEDURE `addRating`(
    IN _score       INT,
    IN _comment     TEXT,
    IN _product     INT,
    IN _user        INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Rating`(
        `rating_score`,
        `rating_comment`,
        `rating_product`,
        `rating_user`
    )VALUES(
        _score,
        _comment,
        _product,
        _user
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyRating`;
DELIMITER $$
CREATE PROCEDURE `modifyRating`(
    IN _idRating    INT,
    IN _score       INT,
    IN _comment     TEXT,
    IN _isEnable    TINYINT,
    IN _user        INT
)
BEGIN
    UPDATE `Cosmeticos`.`Rating` SET
        `rating_score`      =   COALESCE(NULLIF(CASE WHEN _score = 0 THEN NULL ELSE _score END, `rating_score`), `rating_score`),
        `rating_comment`    =   COALESCE(NULLIF(_comment, ""), `rating_comment`),
        `rating_isEnable`   =   _isEnable
    WHERE `rating_id` = _idRating AND `rating_user` = _user;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getRatingByUser`;
DELIMITER $$
CREATE PROCEDURE `getRatingByUser`(
    IN _user       INT
)
BEGIN
    SELECT 
        `rating_id`,      
        `rating_score`,  
        `rating_comment`, 
        `rating_isEnable`,
        `rating_product`
    FROM `Cosmeticos`.`Rating`
    WHERE `rating_user` = _user;
END $$
DELIMITER ;

/*------------------------------STORED PROCEDURE CART---------------------*/
DROP PROCEDURE IF EXISTS `addCart`;
DELIMITER $$
CREATE PROCEDURE `addCart`(
    IN _idUser       INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Carrito`(
        `carrito_user`
    )VALUES(
        _idUser
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addProductInCart`;
DELIMITER $$
CREATE PROCEDURE `addProductInCart`(
    IN _quantity    INT,
    IN _product     INT,
    IN _cart        INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Cart_Item`(
        `cartItem_quantity`,
        `cartItem_product`,
        `cartItem_cart`    
    )VALUES(
        _quantity,
        _product,
        _cart    
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getCartByUser`;
DELIMITER $$
CREATE PROCEDURE `getCartByUser`(
    IN _idUser       INT
)
BEGIN
    SELECT
        `carrito_id`
    FROM `Cosmeticos`.`Carrito`
    WHERE `carrito_user` = _idUser;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getProductsInCart`;
DELIMITER $$
CREATE PROCEDURE `getProductsInCart`(
    IN _idCart       INT
)
BEGIN
    SELECT
        p.`producto_id`,
        p.`producto_name`,
        p.`producto_image`,
        ci.`cartItem_quantity`,
        ci.`cartItem_cart`
    FROM `Cosmeticos`.`Producto` p
    INNER JOIN `Cosmeticos`.`Cart_Item` ci ON p.`product_id` = ci.`cartItem_product`
    WHERE ci.`cartItem_cart` = _idCart AND ci.`cartItem_isEnable` = 1;
END $$
DELIMITER ;

/*--------------------------------------STORED PROCEDURE CONVERSATION-------------------*/
DROP PROCEDURE IF EXISTS `addConversation`;
DELIMITER $$
CREATE PROCEDURE `addConversation`(
    IN _seller    INT,
    IN _buyer     INT,
    IN _product   INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Conversacion`(
        `conversacion_seller`,
        `conversacion_buyer`,
        `conversacion_product`
    )VALUES(
        _seller,
        _buyer,
        _product
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addMessage`;
DELIMITER $$
CREATE PROCEDURE `addMessage`(
    IN _text            TEXT,
    IN _conversation    INT,
    IN _sender          INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Mensaje`(
        `mensaje_text`,
        `mensaje_conversation`,
        `mensaje_sender`
    )VALUES(
        _text,
        _conversation,
        _sender
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getConversationsSeller`;
DELIMITER $$
CREATE PROCEDURE `getConversationsSeller`(
    IN _seller  INT
)
BEGIN
    SELECT 
        `conversacion_id`,
        `conversacion_seller`,
        `conversacion_buyer`,
        `conversacion_product`
    FROM `Cosmeticos`.`Conversacion`
    WHERE `conversacion_seller` = _seller
    AND `conversacion_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getConversationsBuyer`;
DELIMITER $$
CREATE PROCEDURE `getConversationsBuyer`(
    IN _buyer  INT
)
BEGIN
    SELECT 
        `conversacion_id`,
        `conversacion_seller`,
        `conversacion_buyer`,
        `conversacion_product`
    FROM `Cosmeticos`.`Conversacion`
    WHERE `conversacion_buyer` = _buyer
    AND `conversacion_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getAllMessages`;
DELIMITER $$
CREATE PROCEDURE `getAllMessages`(
    IN _idConversation  INT
)
BEGIN
    SELECT cmv.*
    FROM ChatMessagesView cmv
	/*no s� de donde es el ChatMessagesView, en el c�digo solo me aparece aqu�*/
    INNER JOIN `Cosmeticos`.`Conversacion` c on c.`conversacion_id` = _idConversation
    WHERE cmv.`message_conversacion` = _idConversacion
    AND (cmv.`sender_id` = c.`conversacion_seller` OR cmv.`sender_id` = c.`conversacion_buyer`)
    ORDER BY cmv.`message_date`;
END $$
DELIMITER ;

/*---------------------------------STORED PROCEDURES COMPRA Y VENTA-------------------------*/
DROP PROCEDURE IF EXISTS `addSale`;
DELIMITER $$
CREATE PROCEDURE `addSale`(
    IN _productId INT,
    IN _sellerId INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Venta`(
        `venta_producto`,
        `venta_vendedor`
    )VALUES(
        _productId,
        _sellerId
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addPurchase`;
DELIMITER $$
CREATE PROCEDURE `addPurchase`(
    IN _productId INT,
    IN _buyerId INT
)
BEGIN
    INSERT INTO `Cosmeticos`.`Compra`(
        `venta_producto`,
        `venta_vendedor`
    )VALUES(
        _productId,
        _buyerId
    );
END $$
DELIMITER ;


/*----------------------------------FUNCIONES--------------------------------------------*/
/* DELIMITER $$
CREATE FUNCTION averageProductRatings(_productId INT) RETURNS DECIMAL
BEGIN
    DECLARE avgRating DECIMAL;
    SELECT AVG(`rating_score`) INTO avgRating
    FROM `Cosmeticos`.`Rating`
    WHERE `rating_product` = _productId;
    RETURN COALESCE(avgRating, 0);
END$$;
DELIMITER;

DELIMITER $$
CREATE FUNCTION productInCart(_userId INT, _productId INT) RETURNS BOOLEAN
BEGIN
    DECLARE isInCart BOOLEAN;
    SELECT EXISTS (
        SELECT 1
        FROM `Cosmeticos`.`Cart_Item` ci
        WHERE ci.`cartItem_user` = _userId AND ci.`cartItem_product` = _productId AND ci.`cartItem_isEnable` = 1
    ) INTO isInCart;
    RETURN isInCart;
END$$;
DELIMITER; */
/*----------------------------------------TRIGGERS----------------------------------------*/
/*
CREATE TRIGGER approveProduct
BEFORE INSERT ON `Cosmeticos`.`adminMovements`
FOR EACHE ROW
UPDATE `Cosmeticos`.`Product` SET
        `product_isApproved` = 1
    WHERE `product_id` = NEW.`adminMovements_idProduct`
*/

/* CREATE TRIGGER disableProductOnZeroQuantity
BEFORE UPDATE ON `Cosmeticos`.`Product`
FOR EACH ROW
SET NEW.`product_isEnable` = IF(NEW.`product_quantityAvailable` > 0, 1, 0);

CREATE TRIGGER closeConversationOnSale
AFTER INSERT ON `Cosmeticos`.`Sale`
FOR EACH ROW
BEGIN
    UPDATE `Cosmeticos`.`Conversation`
    SET `conversation_isEnable` = 0
    WHERE `conversation_product` = NEW.`sale_product`;
END; */

