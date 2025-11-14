  (function () { //Function IIFE
      
    const formSignup = document.getElementById("nuevoProducto-form");
  
    formSignup.onsubmit = function (e) {
        //Quitar submit
        e.preventDefault();
  
        const iName  =document.getElementById("nombre");
        const iCategory = document.getElementById("categoria");
        const iType = document.getElementById("opciones");   //Saber si es cotización
        const iPrice = document.getElementById("precio");
        const iQuantity = document.getElementById("mucho");
  
  
  
        let errors = [];
  
        if(!iName.value || !iName.value.trim()) {
            errors.push({ msg: "Campo de nombre del producto está vacío." });
        }
        if(!iDescription.value || !iDescription.value.trim()) {
            errors.push({ msg: "Campo de descripción está vacío." });
        }
        
        if(errors.length) {
            alert(JSON.stringify(errors));
            return;
        }
  
  
        
        let xhr = new XMLHttpRequest();
        const product = {
  
          //NOTAAAAA: SIEMPRE los nombres son iguales a los del models!!!!!! aaaaaaAAAA
            name:  iName.value.trim(),
            description: iDescription.value.trim(),
            //image: iImage.value.trim(),
            //video: iVideo.value,
            category: iCategory.value,
            quotation: iType.value,
            price: iPrice.value,
            quantityAvailable: iQuantity.value,
            
        };
  
  
        xhr.open("POST", "../controllers/NuevoProducto.php", true); // true en modo asicrono
        xhr.onreadystatechange = function () {
            //Termina peticion 200 = OK
            try {
                if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                    let res = JSON.parse(xhr.response);
                    if(res.success != true)
                        return;
                    // Sucess ...
                    alert(res.msg);
                    window.location.replace("http://localhost/PureGlow/back/src/views/landingPage.php");
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
  
  
  
  
  