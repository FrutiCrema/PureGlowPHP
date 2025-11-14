<?php
require_once "../database/db.php";

$mysqli = db::connect();

// Consulta SQL para obtener nombres de categorías
$sql = "SELECT category_name, category_id FROM tb_category";
$result = $mysqli->query($sql);



session_start();
$rol = $_SESSION["AUTH"]["user_rol"];
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
<link rel="stylesheet" href="/PureGlow/front/styles/Categorias.css" />
<link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">

<title>PureGlow/Categorías</title>
</head>

<body>
    <!-- Top Nav -->
    <div class="top-nav">
        <div class="container d-flex ">     
        </div>
      </div>

      <div class="navigation">
        <div class="nav-center container d-flex">
          <a href="landingPage.php" class="logo">
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

<!-- Más buscados -->
<section class = "section most-searched">
    <div class="title">
        <h1>MÁS BUSCADOS</h1>
    </div>

    <div class="category-center">
      <div class="category-box">
        <div class="overlay">
          <a href="DetalleProducto.php" class="product-thumb">
            <img src="../../../front/Imagenes/jabon.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
          <a href="./ResultadosCategorias.php"  class='category-item'   data-product-id="17" >Limpieza
          </a>
        </div>
      </div>   
      
      
      <div class="category-box">
        <div class="overlay">
          <a href="DetalleProducto.php" class="product-thumb">
            <img src="../../../front/Imagenes/crema.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <a href="./ResultadosCategorias.php"  class='category-item'   data-product-id="19">Humectantes
          </a>
        </div>
      </div>        


      <div class="category-box">
        <div class="overlay">
          <a href="DetalleProducto.php" class="product-thumb">
            <img src="../../../front/Imagenes/protector solar.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
        <a href="./ResultadosCategorias.php"  class='category-item'   data-product-id="12">Exfoliantes
          </a>
        </div>
      </div>        


      <div class="category-box">
        <div class="overlay">
          <a href="DetalleProducto.php" class="product-thumb">
            <img src="../../../front/Imagenes/serum.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
        <a href="./ResultadosCategorias.php"  class='category-item'   data-product-id="7">Serums
          </a>
        </div>
      </div>        
    </div>
</section>

<section>
        <div class="subtitle">
            <h2>Todas las categorías</h2>
        </div>

        <ul class="category-list" id="category-list">
            <?php
            // Verificar si se obtuvieron resultados
            if ($result->num_rows > 0) {
                // Mostrar cada nombre de categoría como un elemento <li>
                while ($row = $result->fetch_assoc()) {
                    // echo "<li class='category-item' data-product-id= '" . $row["category_id"] . "'><a>" . $row["category_name"] . "</a></li>";
                    echo "<li class='category-item' data-product-id=" . $row["category_id"] . "><a href='#'>" . $row["category_name"] . "</a></li>";                    // echo '<li class="category-item"><a data-product-id=' . $row["category_id"] .' class="bx bx-cart">' . $row["category_name"] . '</a></li>';

                    // echo '<li class="category-item"><a class="carrito-btn" style="pointer-events: none; opacity: 0.5;"><i data-product-id="' . $row["category_id"] . '" class="bx bx-cart"></i>' . $row["category_name"] . '</a></li>';

                }
            } else {
                echo "<li class='category-item'>No hay categorías disponibles</li>";
            }
            ?>
        </ul>
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

<script src="/PureGlow/back/src/js/slider.js"></script>
<script src="/PureGlow/back/src/js/ResultadoCategoria.js"></script>
</body>
</html>
