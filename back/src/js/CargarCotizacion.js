(function () { //Function IIFE

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../controllers/CargarCotizacion.php", true);
    xhr.onreadystatechange = function () {
        //Termina petición 200 = OK
        try {
            if(xhr.readyState == XMLHttpRequest.DONE)  {
                if (xhr.status == 200) {
                    // Éxito, procesar los datos recibidos
                    let datos = JSON.parse(xhr.responseText);

                    if (datos.success && datos.cotizacion) {
                        // Obtener la primera (y única) cotización
                        var cotizacion = datos.cotizacion;

                        // Obtener referencia a los elementos de input
                        var quotation = document.getElementById("precio-input");
                        var specifications = document.getElementById("especificaciones-input");

                        // Establecer los valores en los campos de input
                        quotation.value = cotizacion.quotation_priceAgreed;
                        specifications.value = cotizacion.quotation_specifications;

                        console.log("Precio:", quotation.value);
                        console.log("Especificaciones:", specifications.value);

                    }

                    // Obtener referencias a los elementos de input y al botón
                    var precioInput = document.getElementById("precio-input");
                    var especificacionesInput = document.getElementById("especificaciones-input");
                    var acceptButton = document.getElementById("accept-buttonn");
                    // var EnviarButton = document.getElementById("accept-button");

                    // Función para habilitar o deshabilitar el botón "Aceptar" y cambiar la clase CSS
                    function toggleAcceptButton() {

                        if(datos.cotizacion.quotation_isEnable == 1){
                            if (precioInput.value.trim() && especificacionesInput.value.trim()) {
                                acceptButton.disabled = false;
                                acceptButton.classList.remove('button-disabled');
                                acceptButton.classList.add('button-enabled');
                                console.log("Botón habilitado");

                            } else {
    
                                acceptButton.disabled = true;
                                acceptButton.classList.remove('button-enabled');
                                acceptButton.classList.add('button-disabled');
                                console.log("Botón deshabilitado");
                            }    
                        } else{

                            console.log("entró");
                            acceptButton.disabled = true;
                            acceptButton.classList.remove('button-enabled');
                            acceptButton.classList.add('button-disabled');
                            console.log("Botón deshabilitado");

                            


                        }

                        if(datos.cotizacion.quotation_isEnable == 0)
                        {
                            EnviarButton.disabled = true;
                            EnviarButton.classList.remove('button-enabled');
                            EnviarButton.classList.add('button-disabled');
                            console.log("Botón deshabilitado");
                        }
                        // else{
                        //     EnviarButton.disabled = false;
                        //     EnviarButton.classList.remove('button-disabled');
                        //     EnviarButton.classList.add('button-enabled');
                        //         console.log("Botón habilitado");
                        // }



                    }

                    // Llamar a la función para establecer el estado inicial del botón
                    toggleAcceptButton();

                    // Llamar a la función cuando se escriba en los campos de input
                    precioInput.addEventListener("input", toggleAcceptButton);
                    especificacionesInput.addEventListener("input", toggleAcceptButton);

                }
            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
    }
    // Enviarlo en formato JSON
    xhr.send(JSON.stringify());
})();