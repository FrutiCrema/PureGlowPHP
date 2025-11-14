<?php
session_start();

// Obtiene el rol del usuario de la sesión
$rol = $_SESSION['AUTH']['user_rol'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PureGlow/Usuario</title>
  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="/PureGlow/front/styles/Tarjetas.css">
  <link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">

  <style>
</style>
  
</head>
<body>
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

<div id="creditCardForm">
    <h2>Detalles de la Tarjeta</h2>
    <form id="paymentForm" method="post" onsubmit="return Pagar()">
        <label for="cardNumber">Número de Tarjeta:</label>
        <input type="text" id="cardNumber" name="cardNumber" placeholder="Número de Tarjeta (16 dígitos)" pattern="[0-9]{16}" title="Debe contener exactamente 16 dígitos y ser numéricos" required><br><br>
        <label for="cardExpiry">Fecha de Expiración:</label>
        <input type="text" id="cardExpiry" name="cardExpiry" placeholder="MM/AA" pattern="[0-9]{4}" title="Debe contener exactamente 4 dígitos y ser numéricos" required><br><br>
        <label for="cardCVV">CVV:</label>
        <input type="text" id="cardCVV" name="cardCVV" placeholder="CVV (3 dígitos)" pattern="[0-9]{3}" title="Debe contener exactamente 3 dígitos y ser numéricos" required><br><br>
        <!-- Cambiado el tipo de botón a "submit" -->
        <button type="submit" id="checkoutButton" role="button">Pagar</button>
    </form>
</div>

<script>
function Pagar() {
    console.log("aaa");
    // Aquí puedes realizar cualquier acción adicional antes de redirigir
    
    // Redirigir a la página de Puntuacion.php
    window.location.href = "http://localhost/PureGlow/back/src/views/Puntuacion.php";
    
    // Devolver false para evitar que el formulario se envíe automáticamente
    return false;
}
</script>



<script>

    
</script>
</body>
</html>
