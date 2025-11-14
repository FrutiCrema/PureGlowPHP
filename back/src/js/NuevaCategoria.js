  (function () { //Function IIFE
      
    const formSignup = document.getElementById("nuevoProducto-form");  
  
    formSignup.onsubmit = function (e) {
        //Quitar submit
        e.preventDefault();
  
        const iName  =document.getElementById("nombre");
        const iDescription  =document.getElementById("descripcion");    
  
        let errors = [];
  
        if(!iName.value || !iName.value.trim()) {
            errors.push({ msg: "Campo de nombre está vacío." });
        }
        if(!iDescription.value || !iDescription.value.trim()) {
            errors.push({ msg: "Campo de descripción está vacío." });
        }
        
        if(errors.length) {
            alert(JSON.stringify(errors));
            return;
        }
  
  
        let xhr = new XMLHttpRequest();
        const category = {
  
          //NOTAAAAA: SIEMPRE los nombres son iguales a los del models!!!!!! aaaaaaAAAA
            name:  iName.value.trim(),
            description: iDescription.value.trim(),                  
        };
  
  
        xhr.open("POST", "../controllers/NuevaCategoria.php", true); // true en modo asicrono
        xhr.onreadystatechange = function () {
            //Termina peticion 200 = OK
            try {
                if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                    let res = JSON.parse(xhr.response);

                    console.log(res);
                    if(res.success != true)
                        return;
                    // Sucess ...
                    alert(res.msg);
                    window.location.replace("http://localhost/PureGlow/back/src/views/NuevaCategoria.php");
                }
            } catch(error) {
                // Se imprime el error del servidor
                console.error(xhr.response);
            }
            
        }
        //Enviarlo en formato JSON
        xhr.send(JSON.stringify(category));
    }
  })();
  
  
  
  
  