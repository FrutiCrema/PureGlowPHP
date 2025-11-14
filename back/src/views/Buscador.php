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
</header>
<div class="container">
        <h1>Buscador de Productos/Usuarios</h1>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Buscar por nombre del producto o usuario">
            <button onclick="search()">Buscar</button>
        </div>
        <div class="filters">
            <label for="sortSelect">Ordenar por:</label>
            <select id="sortSelect">
                <option value="1">Menor Precio</option>
                <option value="2">Mayor Precio</option>
                <option value="3">Mejor Calificados</option>
                <option value="4">Mas Vendido</option>
                <option value="5">Menos Vendido</option>
            </select>
        </div>
        <div id="results"></div>
    </div>


    <div id="resultado-consulta">
  <!-- Aquí se mostrarán los resultados de la consulta -->
  </div>


    <script src="/PureGlow/back/src/js/Buscador.js"></script>
    <script src="/PureGlow/back/src/js/slider.js"></script>
</body>
</html>