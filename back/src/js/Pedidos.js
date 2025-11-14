function consultarCompras() {
    let fechaInicio = document.getElementById("fecha-inicio").value;
    let fechaFin = document.getElementById("fecha-fin").value;
    const categoria = document.getElementById("categoria").value;


    if(fechaInicio == '' || fechaFin == '')
    {
        console.log("entré");

        fechaFin = null;
        fechaInicio = null;
    }
    
    const data = {
        fechaInicio: fechaInicio,
        fechaFin: fechaFin,
        categoria: categoria
    };

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/ConsultarCompras.php", true);
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
                // mostrarResultados(res.compras);


                const resultadoConsulta = document.getElementById("resultado-consulta");
                resultadoConsulta.innerHTML = "";
            
                // Mostrar los resultados en el elemento resultadoConsulta
                res.compras.forEach(compra => {
            
                    console.log("ya entréeee")
                    const div = document.createElement("div");
                    div.classList.add("product-info");
                
                    const categoriaSpan = document.createElement("span");
                    categoriaSpan.textContent = compra.Categoria;  // Accediendo correctamente a la propiedad 'Categoria' del objeto 'compra'
                    div.appendChild(categoriaSpan);
                
                    const productoLink = document.createElement("a");
                    productoLink.textContent = compra.Producto;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
                    div.appendChild(productoLink);
                
                    const precioH4 = document.createElement("h4");
                    precioH4.textContent = `$${compra.Precio}`;  // Accediendo correctamente a la propiedad 'Precio' del objeto 'compra'
                    div.appendChild(precioH4);
                
                    resultadoConsulta.appendChild(div);
                });
            

            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
        
    }
    xhr.send(JSON.stringify(data));
}

function mostrarResultados(data) {
    console.log(data);
    
    const resultadoConsulta = document.getElementById("resultado-consulta");
    resultadoConsulta.innerHTML = "";

    // Mostrar los resultados en el elemento resultadoConsulta
    data.forEach(compra => {

        console.log("ya entréeee")
        const div = document.createElement("div");
        div.classList.add("product-info");
    
        const categoriaSpan = document.createElement("span");
        categoriaSpan.textContent = compra.Categoria;  // Accediendo correctamente a la propiedad 'Categoria' del objeto 'compra'
        div.appendChild(categoriaSpan);
    
        const productoLink = document.createElement("a");
        productoLink.textContent = compra.Producto;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
        div.appendChild(productoLink);
    
        const precioH4 = document.createElement("h4");
        precioH4.textContent = `$${compra.Precio}`;  // Accediendo correctamente a la propiedad 'Precio' del objeto 'compra'
        div.appendChild(precioH4);
    
        resultadoConsulta.appendChild(div);
    });
}
