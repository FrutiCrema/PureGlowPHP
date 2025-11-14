(function () { //Function IIFE

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../controllers/CargarMensajes.php", true);
    xhr.onreadystatechange = function () {
        //Termina peticion 200 = OK
        try {
            if(xhr.readyState == XMLHttpRequest.DONE)  {
                if ( xhr.status == 200) {
                    // console.log("Hola");

                    // Éxito, procesar los datos recibidos
                    let datos = JSON.parse(xhr.responseText);

                    let messageList = document.getElementById("message-container");

                    // Limpiar la lista de chats antes de cargar los nuevos
                    messageList.innerHTML = "";

                    // Verificar si success es verdadero y hay un chat
                    if (datos.success && datos.mensajes) {

                        // console.log("Hola pepino");

                        datos.mensajes.forEach(function(mensaje) {
                            // Crear un elemento div para el mensaje
                            var listItem = document.createElement("div");
                            
                            // Verificar si el ID del remitente del mensaje coincide con el ID del usuario actual
                            if (mensaje.mensaje_idSender === datos.idUser) {
                                // Estilo para mensajes enviados por el usuario actual
                                listItem.classList.add("mensaje-enviado");
                            } else {
                                // Estilo para mensajes recibidos de otros usuarios
                                listItem.classList.add("mensaje-recibido");
                            }

                            // Convertir la fecha del mensaje a un objeto Date
                            var messageDate = new Date(mensaje.mensaje_date);

                            // Obtener la hora y los minutos del mensaje
                            var messageHour = messageDate.getHours();
                            var messageMinutes = messageDate.getMinutes();

                            // Formatear la hora y los minutos para que tengan dos dígitos
                            if (messageHour < 10) {
                                messageHour = '0' + messageHour;
                            }
                            if (messageMinutes < 10) {
                                messageMinutes = '0' + messageMinutes;
                            }

                            // Crear la cadena de tiempo formateada
                            var messageTime = messageHour + ':' + messageMinutes;
                            
                            
                            // Crear un elemento strong para el contenido del mensaje
                            var strongElement = document.createElement("div");
                            strongElement.textContent = mensaje.mensaje_text;
                            
                            var strongElement2 = document.createElement("div");
                            strongElement2.textContent = messageTime;


                            // Agregar el elemento strong al listItem
                            listItem.appendChild(strongElement);
                            listItem.appendChild(strongElement2);
                            
                            // Agregar el listItem al contenedor de mensajes
                            messageList.appendChild(listItem);

                        });

                    } else {
                        // No se recibieron datos válidos
                        console.error("No se recibieron datos válidos.");
                    }
                    
                    // Función para abrir un chat cuando se hace clic en un elemento de lista
                    function abrirChat(chatId) {
                        // Aquí puedes definir lo que sucede cuando se abre un chat
                        console.log("Abriendo chat con ID: " + chatId);
                        // Por ejemplo, puedes implementar la lógica para abrir el chat correspondiente
                    }

                    // Agregar scroll al contenedor de mensajes y desplazarlo hacia abajo
                    messageList.style.overflowY = "scroll";
                    messageList.style.height = "300px"; // Puedes ajustar la altura según sea necesario
                    messageList.scrollTop = messageList.scrollHeight;

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




