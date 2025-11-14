(function () { //Function IIFE
    

    //console.log(usernameOriginal);


    const formSignup = document.getElementById("formConfiguracion");

    const iImage = document.getElementById("image");
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
        const iImage = document.getElementById("image");
        const iPassword = document.getElementById("password");
        const iName = document.getElementById("fullname");
        const iBirthdate = document.getElementById("birthdate");
        const iGender = document.getElementById("gender");

        let errors = [];
        // No se valida email porque ya ese esta valdiando desde el formulario

        if(!iUsername.value || !iUsername.value.trim()) {
            errors.push({ msg: "Campo nombre de usuario está vacío." });
        }
        if(!iPassword.value || !iPassword.value.trim()) {
            errors.push({ msg: "Campo contraseña está vacío." });
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



       
        //console.log(base64Imagen);



        let xhr = new XMLHttpRequest();
        const user = {
            email:  iEmail.value.trim(),
            username: iUsername.value.trim(),
            password: iPassword.value.trim(),
            avatar: base64Imagen,
            name: iName.value.trim(),
            birthdate: iBirthdate.value,
            gender: iGender.value,
        };


        xhr.open("POST", "../controllers/Configuracion.php", true); // true en modo asicrono
        xhr.onreadystatechange = function () {
            //Termina peticion 200 = OK
            try {
                if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                    let res = JSON.parse(xhr.response);
                    if(res.success != true)
                        return;
                    // Sucess ...
                    alert(res.msg);
                    window.location.replace("http://localhost/PureGlow/back/src/views/Configuracion.php");
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
    