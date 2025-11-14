<?php
// Aquí deberías tener lógica para verificar el tipo de usuario que ha iniciado sesión
// Supongamos que tienes una variable de sesión llamada $_SESSION['AUTH']['user_rol'] que almacena el tipo de usuario (admin, vendedor, comprador)
session_start();

$id = $_SESSION["INFO_PRODUCT"]['producto_id'];
$name = $_SESSION["INFO_PRODUCT"]['producto_name'];
$description = $_SESSION["INFO_PRODUCT"]['Descripcion'];
$quotation = $_SESSION["INFO_PRODUCT"]['producto_quotation'];
$price = $_SESSION["INFO_PRODUCT"]['producto_price'];
$quantityAvailable = $_SESSION["INFO_PRODUCT"]['producto_quantityAvailable'];
$category = $_SESSION["INFO_PRODUCT"]['category_name'];
$Imagen1 = $_SESSION["INFO_PRODUCT"]['Imagen1'];
$Imagen2 = $_SESSION["INFO_PRODUCT"]['Imagen2'];
$Imagen3 = $_SESSION["INFO_PRODUCT"]['Imagen3'];
$video = $_SESSION["INFO_PRODUCT"]['Video'];
$rating = $_SESSION["INFO_PRODUCT"]['rating'];


$rol = $_SESSION["AUTH"]["user_rol"];

$habilitarBoton = ($rol == 1) ? true : false;
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="/PureGlow/front/styles/DetallesProducto.css" />
    <link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">

    <title>PureGlow/Producto</title>

    <style>
        .details.container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .thumbnails img {
            width: 100px; /* Ajusta el tamaño de las miniaturas según tu preferencia */
            margin: 5px;
            cursor: pointer;
        }
        .thumbnails {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
    </style>

    </style>

  </head>

  <body>
    <!-- Navigation -->
    <div class="top-nav">
      <div class="container d-flex">

      </div>
    </div>
    <div class="navigation">
      <div class="nav-center container d-flex">
        <a href="./landingPage.php" class="logo">
          <div class="logo-container">
              <img src="/PureGlow//front/Imagenes/logo.png" alt="Logo de PureGlow">
              <h1>Pure<span class="glow">Glow</span></h1>
          </div>
        </a>

        <ul class="nav-list d-flex">
          <li class="nav-item">
              <a href="./Productos.php" class="nav-link">Productos</a>
          </li>
          <li class="nav-item">
              <a href="./Categorias.php" class="nav-link">Categorias</a>
          </li>
          <li class="icons d-flex">
                    <div class="search-box">
                        <a href="Buscador.php" class="icon">
                            <button type="button">
                                <i class="bx bx-search"></i>
                            </button>
                        </a>
                    </div>
                </li>

                <li class="icons d-flex">
                    <a href="Perfil.php" class="icon">
                        <i class="bx bx-user"></i>
                    </a>
                    
                  <?php
                  if ($rol == 1)
                  {
                    echo '<a href="Carrito.php" class="icon">';
                    echo '<i class="bx bx-cart"></i>';
                    echo '<span class="d-flex">0</span>';
                    echo '</a>';
                  }
                  ?>
                </li>
            </ul>

            <div class="icons d-flex">
                <!-- Buscador -->
                <div class="search-box">
                        <a href="Buscador.php" class="icon">
                            <button type="button">
                                <i class="bx bx-search"></i>
                            </button>
                        </a>
                </div>

                <!-- Iconos de usuario y carrito -->
                <a href="Perfil.php" class="icon">
                    <i class="bx bx-user"></i>
                </a>
                <?php
                if ($rol == 1)
                {
                  echo '<a href="Carrito.php" class="icon">';
                  echo '<i class="bx bx-cart"></i>';
                  echo '<span class="d-flex">0</span>';
                  echo '</a>';
                }
                ?>
            </div>

        <div class="hamburger">
          <i class="bx bx-menu-alt-left"></i>
        </div>
      </div>
    </div>

    <!-- Product Details -->
    <section class="section product-detail">
    <div class="details container">
        <div class="thumbnails">
            <!-- Miniaturas de las imágenes -->
            <img src="<?php echo $Imagen1; ?>" alt="Imagen 1" onclick="changeImage('<?php echo $Imagen1; ?>')" />
            <img src="<?php echo $Imagen2; ?>" alt="Imagen 2" onclick="changeImage('<?php echo $Imagen2; ?>')" />
            <img src="<?php echo $Imagen3; ?>" alt="Imagen 3" onclick="changeImage('<?php echo $Imagen3; ?>')" />
        </div>
    </div>

    <div class="left image-container">        
        <div class="main">
            <img src=<?php echo $Imagen1; ?> id="zoom" alt="" />
        </div>
    </div>
    
    <div class="right">
        <span><?php echo $category; ?></span>
        <h1><?php echo $name; ?></h1>
        <div class="price">$<?php echo $price; ?></div>

        <form class="form">
            <label for="number">Cantidad disponible: <?php echo $quantityAvailable; ?></label>
            <br>
            <input type="number" id="cantidadInput" placeholder="1" min="1"/>

            <?php
            // Condición para habilitar o deshabilitar el botón "Añadir al Carrito"
            if ($rol == 1) {

              if ($quantityAvailable == 0 && $quotation == 2)
              {
                echo '<button type="submit" class="addCart" data-product-id="' . $id . '">Añadir al Carrito</button>
                <i id="heartIcon" class="bx bx-heart"></i>';
              }else if ($quantityAvailable == 0 && $quotation == 1){
                echo '<button type="submit" class="addCart" data-product-id="' . $id . '" disabled>Añadir al Carrito</button>
                <i id="heartIcon" class="bx bx-heart"></i>          
                ';
              }else{
                echo '<button type="submit" class="addCart" data-product-id="' . $id . '">Añadir al Carrito</button>
                <i id="heartIcon" class="bx bx-heart"></i>';
              }
            } else {
                echo '<button type="submit" class="addCart" data-product-id="' . $id . '" disabled>Añadir al Carrito</button>';
            }
            ?>
        </form>
        
        <h3>DETALLE DEL PRODUCTO</h3>

        <p><?php echo $description; ?></p>
    </div>

</section>

    <!-- Video -->
    <div class="video-container">
        <video id="videoElement" width="500" controls >
            <source id="videoSource" src="<?php echo $video; ?>" type="video/mp4">
        </video>
    </div>



<div class="Comentarioscompleto">
<section class="comments-section">
      <div class="average-rating">
        <h2>Rating Promedio</h2>
        <div class="stars-container">
          <!-- Estrellas aquí -->
        </div>
        <span class="rating-number" id="numeropromedio"><?php echo $rating; ?></span>
      </div>
      <div class="comments-list">
        <!-- <h2>Comentarios</h2>
        <ul>
          <li class="comment">
            <div class="user-info">
              <img src="../Imagenes/pato.png" alt="User Profile Picture">
              <div class="user-details">
                <h3>Nombre de Usuario</h3>
                <div class="stars-container">
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star-half"></i>
                </div>
              </div>
            </div>
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed feugiat mauris eu posuere fermentum.</p>
          </li>
          <li class="comment">
            <div class="user-info">
              <img src="../Imagenes/pato.png" alt="User Profile Picture">
              <div class="user-details">
                <h3>Nombre de Usuario</h3>
                <div class="stars-container">
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star-half"></i>
                </div>
              </div>
            </div>
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed feugiat mauris eu posuere fermentum.</p>
          </li>
          <li class="comment">
            <div class="user-info">
              <img src="../Imagenes/pato.png" alt="User Profile Picture">
              <div class="user-details">
                <h3>Nombre de Usuario</h3>
                <div class="stars-container">
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star-half"></i>
                </div>
              </div>
            </div>
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed feugiat mauris eu posuere fermentum.</p>
          </li>
        </ul> -->
      </div>
    </section>

</div>

    <div class="title" id="Oferta">
      <h1>Otros productos</h1>
      <p>Ofertas del mismo vendedor</p>
    </div>

    <section class="product-carousel">
      <div class="carousel-container">
        <?php include '../controllers/ProductosMismoVendedor.php'; ?>
      </div>
    </section>




    
    

    <!-- Footer -->
     <!-- Footer -->
   <footer class="footer">
    <div class="row">
    <div class="col d-flex">
      <h4>INFORMACIÓN</h4>
      <a href="">Sobre nosotros</a>
      <a href="">Contactanos</a>
      <a href="">Términos y Condiciones</a>
      <a href="">Preguntas Frecuentas</a>
    </div>
    <div class="col d-flex">
      <h4>OTROS LINKS</h4>
      <a href="">Tienda Enlínea</a>
      <a href="">Atención al cliente</a>
      <a href="">Promoción</a>
      <a href="">Top Marcas</a>
    </div>
    <div class="col d-flex">
      <span><i class="bx bxl-facebook-square"></i></span>
      <span><i class="bx bxl-instagram-alt"></i></span>
      <!--<span><i class="bx bxl-github"></i></span>-->
      <span><i class="bx bxl-twitter"></i></span>
      <span><i class="bx bxl-pinterest"></i></span>
    </div>
  </div> 
</footer>

    <!-- Custom Script -->
    <script
      src="https://code.jquery.com/jquery-3.4.0.min.js"
      integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6"
      crossorigin="anonymous">
    </script>
    <script src="/PureGlow/back/src/js/slider.js"></script>
    <script src="/PureGlow/back/src/js/AgregarCarritoDP.js"></script>
  </body>
</html>