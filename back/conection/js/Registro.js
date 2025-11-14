function validarContraseña(contraseña) {
    // Expresión regular para verificar la contraseña
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;
    
    return regex.test(contraseña);
  }
    
  
  function Registro(event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    var email = document.getElementById('email').value;
    var usuario = document.getElementById('username').value;
    var contraseña = document.getElementById('password').value;
    var rol = document.getElementById('role').value;
    var imagen = document.getElementById('avatar').value;
    var nombre = document.getElementById('fullname').value;
    var fechaNacimiento = document.getElementById('birthdate').value;
    var sexo = document.getElementById('gender').value;
    
    
    if (!email) {
        alert('Por favor, ingrese su correo.');
        return false;
    }
    if (!usuario) {
        alert('Por favor, ingrese su usuario.');
        return false;
    }

    if (usuario.length < 3) {
        alert('El nombre de usuario debe tener al menos 3 caracteres.');
        return false;
    }

    if (!contraseña) {
        alert('Por favor, ingrese su contraseña.');
        return false;
    }

    if (!validarContraseña(contraseña)) {
        alert('La contraseña debe tener al menos 8 caracteres y contener al menos un dígito, una letra minúscula, una letra mayúscula y un carácter especial.');
        return false;
      }

    if (!rol) {
        alert('Por favor, ingrese su rol.');
        return false;
    }
    if (!imagen) {
        alert('Por favor, ingrese su imagen.');
        return false;
    }
    if (!nombre) {
        alert('Por favor, seleccione su nombre.');
        return false;
    }
    if (!fechaNacimiento) {
        alert('Por favor, seleccione su fecha de nacimiento.');
        return false;
    }
    if (!sexo) {
        alert('Por favor, seleccione su sexo.');
        return false;
    }
    
    alert("¡Te has registrado con éxito!");
    window.location.href = "../../front/pages/InicioSesion.html";
}

