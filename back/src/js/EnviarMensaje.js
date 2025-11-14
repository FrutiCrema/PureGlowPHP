
function sendMessage() {
    
    const iMensaje = document.getElementById("user-input");

    let errors = [];
    // No se valida email porque ya ese esta valdiando desde el formulario

    if(!iMensaje.value || !iMensaje.value.trim()) {
        errors.push({ msg: "El mensaje está vacío." });
    }

    if(errors.length) {
        alert(JSON.stringify(errors));
        return;
    }

    let xhr = new XMLHttpRequest();
    const chat = {
        text:  iMensaje.value.trim(),
    };

    console.log(iMensaje.value);


    xhr.open("POST", "../controllers/EnviarMensaje.php", true); // true en modo asicrono
    xhr.onreadystatechange = function () {
        //Termina peticion 200 = OK
        try {
            if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                let res = JSON.parse(xhr.response);
                if(res.success != true)
                    return;
                // Sucess ...
                alert(res.msg);
                window.location.replace("http://localhost/PureGlow/back/src/views/Mensajes.php");
            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
        
    }
    //Enviarlo en formato JSON
    xhr.send(JSON.stringify(chat));










    var userInput = document.getElementById("user-input").value;
    if (userInput.trim() !== "") {
        var chatContainer = document.getElementById("message-container");
        var currentTime = new Date().toLocaleTimeString();
        var userMessage = '<div class="mensaje-enviado">' + userInput + '<div class="message-time message-time-user">' + currentTime + '</div></div>';
        chatContainer.innerHTML += userMessage;
        document.getElementById("user-input").value = "";
    }
}
