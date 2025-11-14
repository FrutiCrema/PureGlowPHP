(function () { //Function IIFE
    
    const formSignup = document.getElementById("formConfiguracion");

    const iImage = document.getElementById("avatar");
    let base64Imagen = null;

    // Escuchar el evento change en el input de tipo file
    iImage.addEventListener('change', function() {
        // Verificar si se seleccionó algún archivo
        if (iImage.files && iImage.files[0]) {
            // Crear un objeto FileReader
            const lector = new FileReader();

            // Definir la función que se ejecutará cuando se complete la lectura del archivo
            lector.onload = function(evento) {
                // Obtener la URL del archivo seleccionado (imagen) en formato Base64
                base64Imagen = evento.target.result;
            };

            // Leer el contenido del archivo como una URL de datos (Base64)
            lector.readAsDataURL(iImage.files[0]);
        }
    });


    formSignup.onsubmit = function (e) {
        //Quitar submit
        e.preventDefault();

        const iEmail  =document.getElementById("email");
        const iUsername  =document.getElementById("username");
        const iPassword = document.getElementById("password");
        //const irole = document.getElementById("role");
        //const iImage = document.getElementById("avatar");
        const iName = document.getElementById("fullname");
        const iBirthdate = document.getElementById("birthdate");
        const iGender = document.getElementById("gender");
        const iVisibility = document.getElementById("visibility");

        let errors = [];
        // No se valida email porque ya ese esta valdiando desde el formulario

        if(!iUsername.value || !iUsername.value.trim()) {
            errors.push({ msg: "Campo nombre de usuario está vacío." });
        }
        if(!iPassword.value || !iPassword.value.trim()) {
            errors.push({ msg: "Campo contraseña está vacío." });
        }

        const mensajeValidacion = document.getElementById("mensaje-validacion");

        if (!validarContraseña(iPassword.value)) {
            // La contraseña no cumple con los criterios de validación
            errors.push({ msg: "La contraseña debe tener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial, y tener al menos 8 caracteres de longitud." });
        } else {
            // La contraseña  cumple con los criterios de validación
        }
        
        if(!iImage.value || !iImage.value.trim()) {
            errors.push({ msg: "Campo imagen está vacío." });
        }
        if(!iName.value || !iName.value.trim()) {
            errors.push({ msg: "Campo nombre completo está vacío." });
        }
        if(!iBirthdate.value || !iBirthdate.value.trim()) {
            errors.push({ msg: "Campo fecha de nacimiento está vacío." });
        }

        if(errors.length) {
            alert(JSON.stringify(errors));
            return;
        }


        let xhr = new XMLHttpRequest();
        const user = {
            email:  iEmail.value.trim(),
            username: iUsername.value.trim(),
            password: iPassword.value.trim(),
            role: 3,
            avatar: base64Imagen,
            name: iName.value.trim(),
            birthdate: iBirthdate.value,
            gender: iGender.value,
            visibility: iVisibility.value,
        };


        xhr.open("POST", "../controllers/signup.php", true); // true en modo asicrono
        xhr.onreadystatechange = function () {
            //Termina peticion 200 = OK
            try {
                if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                    let res = JSON.parse(xhr.response);
                    if(res.success != true)
                        return;
                    // Sucess ...
                    alert(res.msg);
                    window.location.replace("http://localhost/PureGlow/index.php");
                }
            } catch(error) {
                // Se imprime el error del servidor
                console.error(xhr.response);
            }
            
        }
        //Enviarlo en formato JSON
        xhr.send(JSON.stringify(user));
    }
})();


function validarContraseña(contraseña) {
    // Expresión regular para verificar la contraseña
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;
    
    return regex.test(contraseña);
  }
    