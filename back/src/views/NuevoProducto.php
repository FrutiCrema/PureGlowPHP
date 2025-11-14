<?php
session_start();

// Obtiene el rol del usuario de la sesión
$rol = $_SESSION['AUTH']['user_rol'];

// Definir las opciones de menú disponibles para cada tipo de usuario
$menuOptions = array(
  //Super admim
  '4' => array(
      'Nuevo Admin' => 'nuevoUsuario.php',
      'Productos Pendientes' => 'productosPendientes.php',
      'Productos Autorizados' => 'productosAutorizados.php'
  ),

  //Admin
  '3' => array(
    'Productos Pendientes' => 'productosPendientes.php',
    'Productos Autorizados' => 'productosAutorizados.php'
  ),

  //Vendedor
  '2' => array(
      'Mensajes' => 'mensajes.php',
      'Mis Productos' => 'misProductos.php',
      'Nuevo Producto' => 'nuevoProducto.php',
      'Ventas' => 'ventas.php',
      'Nueva Categoría' => 'NuevaCategoria.php'
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





// // Conexión a la base de datos
// $servername = "127.0.0.1";
// $username = "root";
// $password = "";
// $database = "db_pureglow";

// $conn = new mysqli($servername, $username, $password, $database);

// // Verificar conexión
// if ($conn->connect_error) {
//     die("Conexión fallida: " . $conn->connect_error);
// }

// // Consulta SQL para obtener nombres de categorías
// $sql = "SELECT category_name FROM tb_category";
// $result = $conn->query($sql);

// // Cerrar conexión
// $conn->close();
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



<h2>Nuevo Producto</h2>
    <form action="#"id="nuevoProducto-form" method="POST" onsubmit="return nuevoProductoForm()" enctype="multipart/form-data">
      <div>
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>
      <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
      </div>
      <div>
        <label for="imagenes">Imágenes (Seleciona: 3):</label>
        <input type="file" id="imagenes" name="imagenes" accept="image/*" multiple required>
        <p id="mensaje-imagenes" style="display:none; color:red;">Selecciona solo tres imágenes.</p>
      </div>
      <div>
        <label for="video">Video (Selecciona: 1):</label>
        <input type="file" id="video" name="video" accept="video/*" required>
        <!-- <p id="mensaje-video" style="display:none; color:red;">Selecciona solo tres imágenes.</p> -->
      </div>
      <div>
        <?php include '../controllers/TraerCategorias.php'; ?>
      </div>
      <div>
        <label for="tipo">¿Es para cotizar o para vender?</label>
        <select id="opciones" name="tipo" onchange="checkTipo()" required>
          <option value="1">Vender</option>
          <option value="2">Cotizar</option>
        </select>
      </div>
      <div>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" min="0" step="0.01" required>
      </div>
      <div>
        <label for="cantidad">Cantidad disponible:</label>
        <input type="number" id="mucho" name="cantidad" min="0" required>
      </div>
      <div>
        <button type="submit">Enviar</button>
      </div>
    </form>  



 <!-- Footer -->
 <!-- Hasta que descubra como hacer que footer NO ME TAPE las cosas. Mayúsculas para encontrar el comentario -->
 <!-- <footer class="footer">
 
</footer> -->



<!-- Script JavaScript -->
<script src="/PureGlow/back/src/js/slider.js"></script>
<!-- <script src="/PureGlow/back/src/js/BuscarCategoria.js"></script> -->
<script 
var idUser = "<?php echo $_SESSION["AUTH"]["user_id"]; ?>"; 
src="/PureGlow/back/src/js/NuevoProducto.js">
</script>

<script src="/PureGlow/back/src/js/CerrarSesion.js"></script>



</body>
</html>
