(function () { //Function IIFE

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../controllers/CargarChats.php", true);
    xhr.onreadystatechange = function () {
        //Termina peticion 200 = OK
        try {
            if(xhr.readyState == XMLHttpRequest.DONE)  {
                if ( xhr.status == 200) {
                    // Éxito, procesar los datos recibidos

                    let datos = JSON.parse(xhr.responseText);

                    let chatsList = document.getElementById("chats-list");

                    // Limpiar la lista de chats antes de cargar los nuevos
                    chatsList.innerHTML = "";

                    // Verificar si success es verdadero y hay un chat
                    if (datos.success && datos.chats) {
                        datos.chats.forEach(function(chat) {
                            // Manipular el chat según sea necesario
                            // Por ejemplo, agregarlo directamente a la lista de chats

                            var listItem = document.createElement("div");
                            listItem.style.borderBottom = "1px solid #ccc";
                            listItem.style.paddingBottom = "10px";
                            listItem.style.marginBottom = "10px";
                            listItem.style.cursor = "pointer"; // Añadir cursor: pointer aquí

                            // Crear un elemento strong y añadir estilos
                            var strongElement = document.createElement("strong");
                            strongElement.style.fontWeight = "bold"; // Añadir negrita
                            strongElement.style.color = "#333"; // Cambiar el color del texto
                            strongElement.textContent = "Chat con: " + chat.other_user_name; // Texto dentro del elemento strong

                            // Añadir el elemento strong al listItem
                            listItem.appendChild(strongElement);

                            //listItem.textContent = "Chat con: " + chat.other_user_name;
                    
                            // Agregar el controlador de eventos onclick
                            listItem.onclick = function() {
                                // Aquí puedes definir lo que sucede cuando se hace clic en el elemento de lista
                                abrirChat(chat.conversacion_id); // Abrir el chat correspondiente
                            };
                    
                            chatsList.appendChild(listItem);
                        });
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



    // Función para abrir un chat cuando se hace clic en un elemento de lista
function abrirChat(chatId) {

    window.location.href = "../controllers/GuardarChatId.php?chatId=" + chatId;
}

})();




