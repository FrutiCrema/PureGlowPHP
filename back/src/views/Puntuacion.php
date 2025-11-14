<?php
session_start();

$rol = $_SESSION["AUTH"]["user_rol"];

$productos = isset($_SESSION['PRODUCTOS_CARRITO']) ? $_SESSION['PRODUCTOS_CARRITO'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="/PureGlow/front/styles/Puntuacion.css" />
    <link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">
    <title>PureGlow/Carrito</title>



    <style>
  .product-center {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    max-width: 120rem;
    margin: 0 auto;
    padding: 0 2rem;
  }
        .product-review {
            flex: 0 1 calc(33.333% - 20px); /* 3 productos por fila, ajusta según tus necesidades */
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        .product-image {
            max-width: 100%;
            height: auto;
        }
        .rating {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .stars {
            display: flex;
        }
        .comment-box {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
        }
        .submit-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
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

    <div class="product-reviews">
    <?php
    if (!empty($productos)) {
            echo '<div class="product-center">';

            foreach ($productos as $producto) {
                echo '<div class="product-review">';
                echo '<p class="name_product">' . $producto['producto_name'] . '</p>';
                echo '<img src="' . $producto['Contenido_imagen'] . '" alt="Producto" class="product-image">';
                echo '<div class="rating">';
                echo '<input type="number" min="1" max="5" step="1" value="5" class="rating-input">';
                echo '<div class="stars" id="star-container">';
                echo '<i class="bx bxs-star"></i>';
                echo '<i class="bx bxs-star"></i>';
                echo '<i class="bx bxs-star"></i>';
                echo '<i class="bx bxs-star"></i>';
                echo '<i class="bx bxs-star"></i>';
                echo '</div>';
                echo '</div>';
                echo '<textarea placeholder="Escribe un comentario" class="comment-box" required></textarea>';
                echo '<input type="hidden" class="product-id" value="' . $producto['cartItem_idProduct'] . '">';
                echo '</div>';
            }
            echo '</div>'; // Cierra product-container
            echo '<button class="submit-btn" onclick="Puntuacion()">Calificar</button>';
        } else {
            echo '<p>No hay productos en el carrito.</p>';
        }
        ?>    
           </div>
    
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
    <script src="/PureGlow/back/src/js/slider.js"></script>
    <script src="/PureGlow/back/src/js/Puntuacion.js"></script>
</body>
</html>

