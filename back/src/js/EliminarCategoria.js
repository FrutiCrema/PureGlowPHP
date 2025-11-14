(function () { //Function IIFE

    const formSignup = document.getElementById("formConfiguracion");


    formSignup.onsubmit = function (e) {
        //Quitar submit
        e.preventDefault();

        const iCategory = document.getElementById("categoria").value;

        const category = {
            category:  iCategory,
        };

        let xhr = new XMLHttpRequest();

        xhr.open("POST", "../controllers/EliminarCategoria.php", true); // true en modo asicrono
        xhr.onreadystatechange = function () {
            //Termina peticion 200 = OK
            try {
                if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                    let res = JSON.parse(xhr.response);
                    if(res.success != true)
                        return;
                    // Sucess ...
                    alert(res.msg);
                    window.location.replace("http://localhost/PureGlow/back/src/views/EliminarCategoria.php");
                }
            } catch(error) {
                // Se imprime el error del servidor
                console.error(xhr.response);
            }
            
        }
        //Enviarlo en formato JSON
        xhr.send(JSON.stringify(category));
    }
})();


function validarContraseña(contraseña) {
    // Expresión regular para verificar la contraseña
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;
    
    return regex.test(contraseña);
  }
    