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
    <link rel="stylesheet" href="../../../front/styles/Registro.css" />
    <link rel="icon" href="../../../front/Imagenes/logo.png" type="image/png">
    <title>PureGlow/Registro</title>
  </head>

  <body>
    <!-- Navigation -->
    <div class="top-nav">
      <div class="container d-flex ">
        <ul class="d-flex">
          <li><a href="./login.php">Inicio Sesión</a></li>
        </ul>
      </div>
    </div>

    <div class="navigation">
      <div class="nav-center container d-flex">
        <a href="./landingPage.php" class="logo">
          <div class="logo-container">
                  <img src="../../../front/Imagenes/logo.png" alt="Logo de PureGlow">
              <h1>Pure<span class="glow">Glow</span></h1>
          </div>
        </a>
      </div>
    </div>


<!-- Login -->
<div class="container">
  <div class="login-form">
    <form action="#" id="registroForm" method="post" >
      <h1>Registro</h1>

      <label for="email">Correo electrónico</label>
      <input type="email" id="email" placeholder="Ingrese correo electrónico" name="email" required />

      <label for="username">Nombre de usuario</label>
      <input type="text" id="username"  placeholder="Ingrese nombre de usuario" name="username" minlength="3" required />

      <label for="password">Contraseña</label>
      <input type="password" id="password" placeholder="Introducir la contraseña" name="password" required />

      <label for="role">Rol</label>
      <select id="role" name="role" required>
        <option value="1">Cliente</option>
        <option value="2">Vendedor</option>
      </select>

      <label for="avatar">Imagen de avatar</label>
      <input type="file" id="avatar" accept="image/*" name="avatar" required />

      <label for="fullname">Nombre completo</label>
      <input type="text" id="fullname" placeholder="Ingrese su nombre completo" name="fullname" required />

      <label for="birthdate">Fecha de nacimiento</label>
      <input type="date" id="birthdate" name="birthdate" required />

      <label for="gender">Sexo</label>
      <select id="gender" name="gender" required>
        <option value="masculino">Masculino</option>
        <option value="femenino">Femenino</option>
        <option value="otro">Otro</option>
      </select>
      
      <label for="visibility">¿Perfil privado o público?</label>
      <select id="visibility" name="visibility" required>
        <option value="1">Público</option>
        <option value="2">Privado</option>
      </select>

   
      <div class="buttons">
        <button type="submit">Registrarse</button>
      </div>
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

    <!-- Custom Script -->
    <script src="../js/signup.js"></script>
  </body>
</html>
