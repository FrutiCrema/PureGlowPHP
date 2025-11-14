<?php
session_start();

//Hago esto porque cuando quiera cerrar sesión se limpie esta variable 
//y pueda proceder de mejor manera
unset($_SESSION["AUTH"]);
unset($_SESSION["INFO_ID_CHAT"]);


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
    <link rel="stylesheet" href="/PureGlow/front/styles/InicioSesion.css" />
    <link rel="icon" href="/PureGlow/front/Imagenes/logo.png" type="image/png" />
    <title>PureGlow/Inicio de sesión</title>
  </head>

  <body>
    <!-- Navigation -->
    <div class="top-nav">
      <div class="container d-flex ">
        <ul class="d-flex">
        </ul>
      </div>
    </div>

    <div class="navigation">
      <div class="nav-center container d-flex">
        <a href="/PureGlow/index.php" class="logo">
          <div class="logo-container">
            <img src="/PureGlow/front/Imagenes/logo.png" alt="Logo de PureGlow" />
            <h1>Pure<span class="glow">Glow</span></h1>
          </div>
        </a>
      </div>
    </div>

    <!-- Login -->
    <div class="container">
      <div class="login-form">
        <form action="/api/login" id="formLogin" method="post">
          <h1>Inicio Sesión</h1>
          <label for="username">Usuario o correo electrónico</label>
          <input
            type="text"
            id="username"
            placeholder="Introduzca el usuario o correo"
            name="username"
            required
          />

          <label for="psw">Contraseña</label>
          <input
            type="password"
            id="psw"
            placeholder="Introduzca la contraseña"
            name="password"
            required
          />

          <div class="buttons">
            <button class="btn btn-primary" role="button" type="submit">Iniciar</button>
          </div>
          <p></p>
          <p>
            ¿Aún no tienes cuenta? <a href="/PureGlow/back/src/views/Registro.php" class="registro-link" style="color: #00255c;">Registrate aquí</a>
          </p>
        </form>
      </div>
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

    <script src="/PureGlow/back/src/js/login.js"></script>
  </body>
</html>
