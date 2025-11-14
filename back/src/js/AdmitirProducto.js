// JavaScript
document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los botones "Admitir"
    const admitirButtons = document.querySelectorAll(".admitir-btn");

    // Iterar sobre cada botón y agregar un evento clic
    admitirButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            // Obtener el ID del producto desde el atributo data-id
            const productId = this.value;

            // Realizar una solicitud AJAX para enviar el ID del producto al controlador
            const xhr = new XMLHttpRequest();

            const product = {

                //NOTAAAAA: SIEMPRE los nombres son iguales a los del models!!!!!! aaaaaaAAAA
                id: productId,
            }
        
            console.log(productId);

            xhr.open("POST", "../controllers/AdmitirProducto.php", true); // true en modo asicrono
            xhr.onreadystatechange = function () {
            //Termina peticion 200 = OK
            try {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Hacer algo con la respuesta del controlador si es necesario

                    window.location.replace("http://localhost/PureGlow/back/src/views/ProductosPendientes.php");
                    console.log(xhr.responseText);
                }
            } catch(error) {
              // Se imprime el error del servidor
              console.error(xhr.response);
            }
          
            }     
            //Enviarlo en formato JSON
            xhr.send(JSON.stringify(product));



        });
    });
});
