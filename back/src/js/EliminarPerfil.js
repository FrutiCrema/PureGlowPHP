function eliminarPerfil(idUser) {


    const user = {
        id: idUser
    };

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/EliminarPerfil.php", true); // true en modo asicrono
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
                        window.location.href = "http://localhost/PureGlow/index.php";
                    }
                } catch(error) {
                    // Se imprime el error del servidor
                    console.error(xhr.response);
                }
                
            }
            //Enviarlo en formato JSON
            xhr.send(JSON.stringify(user));

}