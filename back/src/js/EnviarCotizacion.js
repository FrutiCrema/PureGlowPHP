function sendQuotation(){

    const iPrecio = document.getElementById("precio-input");
    const iEspecificaciones = document.getElementById("especificaciones-input");

    let errors = [];

    if(!iPrecio.value || !iPrecio.value.trim()) {
        errors.push({ msg: "El precio está vacío." });
    }

    if(!iEspecificaciones.value || !iEspecificaciones.value.trim()) {
        errors.push({ msg: "Las especificaciones están vacías." });
    }

    if(errors.length) {
        alert(JSON.stringify(errors));
        return;
    }

    let xhr = new XMLHttpRequest();
    const product = {
        priceAgreed:  iPrecio.value.trim(),
        specifications:  iEspecificaciones.value.trim(),
    };

    xhr.open("POST", "../controllers/EnviarCotizacion.php", true); // true en modo asicrono
    xhr.onreadystatechange = function () {
        //Termina peticion 200 = OK
        try {
            if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                let res = JSON.parse(xhr.response);
                console.log(res); // Imprimir el contenido de la variable res en la consola
                if(res.success != true) {
                    alert(res.msg);
                    return;
                }
                // Sucess ...
                alert(res.msg);
                window.location.href = "http://localhost/PureGlow/back/src/views/Mensajes.php";
            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
        
    }
    //Enviarlo en formato JSON
    xhr.send(JSON.stringify(product));

}
    

function aceptarCotizacion(){
    let xhr = new XMLHttpRequest(); 

    xhr.open("POST", "../controllers/AceptarCotizacion.php", true); // true en modo asicrono
    xhr.onreadystatechange = function () {
        //Termina peticion 200 = OK
        try {
            if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                let res = JSON.parse(xhr.response);
                console.log(res); // Imprimir el contenido de la variable res en la consola
                if(res.success != true) {
                    alert(res.msg);
                    return;
                }
                // Sucess ...
                alert(res.msg);
                window.location.href = "http://localhost/PureGlow/back/src/views/PuntuacionCotizacion.php";
            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
        
    }
    //Enviarlo en formato JSON
    xhr.send(JSON.stringify());

}