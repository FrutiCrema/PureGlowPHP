<?php
session_start();

$rol = $_SESSION["AUTH"]["user_rol"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Boxicons -->
<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
<!-- Glide js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.css">
<!-- Custom StyleSheet -->
<link rel="stylesheet" href="/PureGlow/front/styles/index.css" />
<link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">
<title>PureGlow</title>
</head>

<body>
<!-- Header -->
<header class="header" id="header">
    <!-- Top Nav -->
    <div class="top-nav">
        <div class="container d-flex ">
        </div>
    </div>

    <div class="navigation">
        <div class="nav-center container d-flex">
            <a href="/PureGlow/back/src/views/landingPage.php" class="logo">
                <div class="logo-container">
                    <img src="/PureGlow/front/Imagenes/logo.png" alt="Logo de PureGlow">
                    <h1>Pure<span class="glow">Glow</span></h1>
                </div>
            </a>

            <ul class="nav-list d-flex">
                <li class="nav-item">
                    <a href="Productos.php" class="nav-link">Productos</a>
                </li>
                <li class="nav-item">
                    <a href="Categorias.php" class="nav-link">Categorias</a>
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
    <!-- Promo -->
    <section class="section banner">
        <div class="left">
            <h1>¡Bienvenido! </h1>
            <p>Haz que tu piel brille </p>
        </div>
        <div class="right">
            <img src="../../../front/Imagenes/banner.png" alt="">
        </div>
    </section>
</header>


    <!-- New Arrivals -->
    <section class="section new-arrival">
      <div class="title">
        <h1>NUEVO</h1>
        <p>Descubre los nuevos productos que tenemos para ti</p>
      </div>

      <div class="product-center">
        <?php include '../controllers/SeccionNuevos.php'; ?>
      </div>
    </section>

    <section class="section banner2">
      <div class="right">
        <h1>KYLIE SKIN! </h1>
        <p>Ahora encuentra todo lo de</p>
        <p>KYLIE SKIN en PureGlow</p>
      </div>
      <div class="left">
        <img src="../../../front/Imagenes/kylei.png" alt="">
      </div>
    </section>


    <!-- Most Sold -->
    <section class="section most-sold">
      <div class="title">
        <h1>MEJORES CALIFICADOS</h1>
        <p>Descubre nuestros best sellers</p>
      </div>

      <div class="product-center">
        <?php include '../controllers/SeccionRating.php'; ?>
      </div>

      </div>
    </section>
    </div>
</section>

<!-- Agrega aquí el resto de las secciones -->

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
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
<script src="/PureGlow/back/src/js/slider.js"></script>
<script src="/PureGlow/back/src/js/index.js"></script>
</html>
