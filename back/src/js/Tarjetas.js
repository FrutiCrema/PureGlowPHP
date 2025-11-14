(function () { //Function IIFE
    
    const formLogin = document.getElementById("paymentForm");

    console.log("hola");
    formLogin.onsubmit = function (e) {

        console.log("holass");

        //Quitar submit
        e.preventDefault();
        const iCardNumber = document.getElementById("cardNumber");
        const iCardExpiry = document.getElementById("cardExpiry");
        const iCardCVV = document.getElementById("cardCVV");


        let errors = [];
        if(!iCardNumber.value || !iCardNumber.value.trim()) {
            errors.push({ msg: "Campo número de tarjeta está vacío." });
        }
        if(!iCardExpiry.value || !iCardExpiry.value.trim()) {
            errors.push({ msg: "Campo fecha de expiración está vacío." });
        }

        if(!iCardCVV.value || !iCardCVV.value.trim()) {
            errors.push({ msg: "Campo CVV está vacío." });
        }

        if(errors.length) {
            alert(JSON.stringify(errors));
            return;
        }

        const product = {
            CardNumber: iCardNumber.value.trim(),
            CardExpiry: iCardExpiry.value.trim(),
            CardCVV: iCardCVV.value.trim()
        };

        let xhr = new XMLHttpRequest();

        xhr.open("POST", "../controllers/Tarjetas.php", true); // true en modo asicrono
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
                    window.location.href = "http://localhost/PureGlow/back/src/views/landingPage.php";
                }
            } catch(error) {
                // Se imprime el error del servidor
                console.error(xhr.response);
            }
            
        }
        //Enviarlo en formato JSON
        xhr.send(JSON.stringify(product));
    }
})();