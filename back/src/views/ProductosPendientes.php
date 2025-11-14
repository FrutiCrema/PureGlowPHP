<?php
// Aquí deberías tener lógica para verificar el tipo de usuario que ha iniciado sesión
// Supongamos que tienes una variable de sesión llamada $_SESSION['AUTH']['user_rol'] que almacena el tipo de usuario (admin, vendedor, comprador)
session_start();

// Obtiene el rol del usuario de la sesión
$rol = $_SESSION['AUTH']['user_rol'];

// Definir las opciones de menú disponibles para cada tipo de usuario
$menuOptions = array(
  //Super admim
    '4' => array(
      'Nuevo Admin' => 'nuevoUsuario.php',
      'Productos Pendientes' => 'productosPendientes.php',
      'Productos Autorizados' => 'productosAutorizados.php',
      'Eliminar Categorías' => 'EliminarCategorias.php'
  ),

  //Admin
  '3' => array(
    'Productos Pendientes' => 'productosPendientes.php',
    'Productos Autorizados' => 'productosAutorizados.php',
    'Eliminar Categorías' => 'EliminarCategorias.php'
  ),

  //Vendedor
  '2' => array(
      'Mensajes' => 'mensajes.php',
      'Mis Productos' => 'misProductos.php',
      'Nuevo Producto' => 'nuevoProducto.php',
      'Ventas' => 'ventas.php'
  ),

  //Comprador
  '1' => array(
      'Mensajes' => 'mensajes.php',
      'Métodos de Pago' => 'pagos.php',
      'Listas de Deseos' => 'wishlist.php',
      'Pedidos' => 'pedidos.php'
  ),

  //Comun
  'comun' => array(
      'Perfil' => 'perfil.php',
      'Configuración del Perfil' => 'configuracion.php',
  )
);

// Función para generar el menú según el tipo de usuario
function generateMenu($menuOptions, $rol) {
  if (isset($rol)) {
      // Imprimir todas las opciones comunes
      foreach ($menuOptions['comun'] as $label => $url) {
          echo "<li><a href=\"$url\">$label</a></li>";
      }

      // Imprimir las opciones específicas del rol del usuario
      if (isset($menuOptions[$rol])) {
          foreach ($menuOptions[$rol] as $label => $url) {
              echo "<li><a href=\"$url\">$label</a></li>";
          }
      }
  }

  // Imprimir opción "Cerrar Sesión" al final del menú
  echo "<li><a href=\"#\" onclick=\"cerrarSesion()\">Cerrar Sesión</a></li>";
}
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
  <link rel="stylesheet" href="/PureGlow/front/styles/Configuracion.css">
  <link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png">
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


<!-- Menú -->
<div class="menu">
  <ul>
    <?php generateMenu($menuOptions, $rol); ?>
  </ul>
</div>



<h2>Productos pendientes</h2>   

<section class="section new-arrival">
    <div class="product-center">
        <?php include '../controllers/ProductosPendientes.php'; ?>
    </div>
</section>

  
     

 <!-- Footer -->
 <!-- Hasta que descubra como hacer que footer NO ME TAPE las cosas. Mayúsculas para encontrar el comentario -->
 <!-- <footer class="footer">
 
</footer> -->

<!-- Script JavaScript -->
<script src="../js/slider.js"></script>
<script src="../js/CerrarSesion.js"></script>


</body>
</html>
