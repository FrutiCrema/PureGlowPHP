(function () { //Function IIFE

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../controllers/CargarInfoProductoMensajes.php", true);
    xhr.onreadystatechange = function () {
        //Termina peticion 200 = OK
        try {
            if(xhr.readyState == XMLHttpRequest.DONE)  {
                if ( xhr.status == 200) {

                    // Éxito, procesar los datos recibidos
                    let datos = JSON.parse(xhr.responseText);

                    let messageList = document.getElementById("product-container");

                    // console.log(datos.producto);

                    // Verificar si success es verdadero y hay un chat
                    if (datos.success && datos.producto) {
                        console.log("Hola");

                        var infoAntes = document.createElement("h3");
                        infoAntes.textContent = "Información del Producto";

                        var infoAntes2 = document.createElement("p");
                        infoAntes2.textContent = "Nombre del Producto:";
    
                            // Crear un elemento div para el mensaje
                            var nombreProducto = document.createElement("p");
                            nombreProducto.textContent = datos.producto.producto_name;
                            nombreProducto.style.maxWidth = "200px";
                            nombreProducto.style.margin = "10px";


                            console.log("hola");

                            var imagenProducto = document.createElement("img");
                            imagenProducto.src = datos.producto.imagen_content ;
                            imagenProducto.alt = "Imagen del Producto";
                    
                            // Establecer el ancho máximo de la imagen
                            imagenProducto.style.maxWidth = "200px";

                            // Limpiar el contenedor antes de agregar nuevos elementos
                            var productInfo = document.getElementById("product-info");
                            productInfo.innerHTML = "";
                    
                            // Agregar elementos al contenedor
                            productInfo.appendChild(infoAntes);
                            productInfo.appendChild(infoAntes2);
                            productInfo.appendChild(nombreProducto);
                            productInfo.appendChild(imagenProducto);                       

                    } else {
                        // No se recibieron datos válidos
                        console.error("No se recibieron datos válidos.");
                    }
                }
            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
    }
    //Enviarlo en formato JSON
    xhr.send(JSON.stringify());
})();




