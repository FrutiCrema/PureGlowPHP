<?php
session_start();
$rol = $_SESSION["AUTH"]["user_rol"];


$name = $_SESSION["INFO_CATEGORIA"]["category_name"];
$description = $_SESSION["INFO_CATEGORIA"]["category_description"];
$idCategory = $_SESSION["INFO_CATEGORIA"]["category_id"];
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
    <link rel="stylesheet" href="/PureGlow/front/styles/ResultadosCategorías.css" />
    <link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">
    <title>PureGlow/Productos</title>
  </head>

  <body>
    <!-- Navigation -->
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


    <!-- All Products -->
    <section class="section all-products" id="products">
      <div class="top container">
        <h1><?php echo $name; ?></h1>
      </div>

      <div class="category-info">
        <h3 class="product-name">Descripción</h3>
        <p class="product-description"><?php echo $description; ?></p>
      </div>
      <div class="product-center container">
        <?php include '../controllers/ProductosCategorias.php'; ?>
      </div>


        

    </section>


    <section class="pagination">
      <div class="container">
        <span>1</span> <span>2</span> <span>3</span> <span>4</span>
        <span><i class="bx bx-right-arrow-alt"></i></span>
      </div>
    </section>


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
    
    <script src="/back/src/js/slider.js"></script>
  </body>
</html>
