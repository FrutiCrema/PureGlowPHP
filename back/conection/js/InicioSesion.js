function inicioSesion(event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    var usuario = document.getElementById('username').value;
    var contraseña = document.getElementById('psw').value;


    if (!usuario) {
        alert('Por favor, ingrese su usuario o correo.');
        return false;
    }
    if (!contraseña) {
        alert('Por favor, ingrese su contraseña.');
        return false;
    }


    alert("¡Inicio de sesión exitoso!");
    window.location.href = "../../index.html";

}
