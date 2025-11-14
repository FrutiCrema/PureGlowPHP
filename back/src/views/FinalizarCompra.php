<?php
session_start();

$rol = $_SESSION["AUTH"]["user_rol"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Box icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="/PureGlow/front/styles/Finalizarcompra.css">
    <link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">
    <title>PureGlow/Finalizar Compra</title>
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
              <img src="/PureGlow/front/Imagenes/logo.png" alt="Logo de PureGlow">
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

<br><br>
<table>
  <tr>
    <td nowrap>
      <div class="container">
        <div class="products">
          <h2>Productos</h2>
          <!-- Aquí va la lista de productos -->
          <div class="product">
              <img src="../Imagenes/jabon.jpg" alt="Producto 1">
              <div class="details">
                  <h3 id="Títuloproducto">Nombre del Producto</h3>
                  <p>Cantidad: 2</p>
              </div>
          </div>
          <!-- Más productos aquí -->
      </div>
      </div>
    </td>

    <td nowrap>
      <div class="container">

        <div class="summary">
          <h2>Resumen de la Compra</h2>
          <p>Total de Productos: 3</p>
          <p>Costo de Productos: $150</p>
          <p>Costo de Envío: $10</p>
          <p>Total a Pagar: $160</p>
          
          <button onclick="window.location.href='./Puntuacion.php'" class="checkout-btn">Finalizar Compra</button>
      </div>

      </div>
    </td>
</tr>


<!--<tr>
<td nowrap>
  <div class="container">
        <div class="payment-methods">
          <h2>Métodos de Pago</h2>
          <label for="transferencia">
            <input type="radio" id="transferencia" name="payment" value="transferencia">
            <img src="../Imagenes/banco.webp" alt="Transferencia">
              Transferencia Bancaria
          </label>
          <label for="tarjeta-debito">
              <input type="radio" id="tarjeta-debito" name="payment" value="tarjeta-debito">
              <img src="../Imagenes/credit-card-icon-png-4408.png" alt="Tarjeta de Débito">
              Tarjeta de Débito
          </label>
          <label for="tarjeta-credito">
              <input type="radio" id="tarjeta-credito" name="payment" value="tarjeta-credito">
              <img src="../Imagenes/credit-card-icon-png-4408.png" alt="Tarjeta de Crédito">
              Tarjeta de Crédito
          </label>
      </div>
      </div></td>
<td></td>
</tr> -->
</table>

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
    <script src="../js/slider.js"></script>
</body>
</html>
