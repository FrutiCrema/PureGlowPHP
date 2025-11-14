document.addEventListener("DOMContentLoaded", function() {
    const checkbox = document.getElementById("consulta_detallada");
    const fechaFin = document.getElementById("fecha-fin");
    
    // Función para actualizar el estado del campo fecha-fin
    function updateFechaFinState() {
        if (checkbox.checked) {
            fechaFin.disabled = false;
        } else {
            fechaFin.disabled = true;
            fechaFin.value = ""; // Limpiar el valor de fecha-fin si no está activo
        }
    }

    // Llamar a la función al cargar la página y al cambiar el checkbox
    checkbox.addEventListener("change", updateFechaFinState);
    updateFechaFinState();
});

function consultarCompras() {
    const fechaInicio = document.getElementById("fecha-inicio").value;
    const fechaFin = document.getElementById("fecha-fin").value;
    const categoria = document.getElementById("categoria").value;
    const consultaDetallada = document.getElementById("consulta_detallada").checked;

    // Crear un objeto con los datos del formulario
    const formData = {
        fechaInicio: fechaInicio,
        fechaFin: consultaDetallada ? fechaFin : null, // Solo enviar fechaFin si el checkbox está seleccionado
        categoria: categoria,
        consultaDetallada: consultaDetallada
    };

    // Llamar a la función de consulta (puede ser una llamada AJAX o similar)
    console.log(formData);
    // Aquí puedes agregar tu llamada AJAX para enviar formData al servidor
}




function consultarCompras() {
    let fechaInicio = document.getElementById("fecha-inicio").value;
    let fechaFin = document.getElementById("fecha-fin").value;
    const categoria = document.getElementById("categoria").value;
    const consultaDetallada = document.getElementById("consulta_detallada").checked;

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




    if(consultaDetallada == true)
    {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/ConsultarVentasDetallada.php", true);
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

                        const quantity = document.createElement("a");
                        quantity.textContent = 'Existen: ' + compra.Existencia;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
                        div.appendChild(quantity);

                    
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
    
    } else {


        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/ConsultarVentasAgrupada.php", true);
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
                
                        const div2 = document.createElement("div");

                        const ventas = document.createElement("span");
                        ventas.textContent = "Total vendido ese mes:" + compra.Ventas;  // Accediendo correctamente a la propiedad 'Categoria' del objeto 'compra'
                        div2.appendChild(ventas);

                        const div = document.createElement("div");
                        div.classList.add("product-info");

    
    
                    
                        const categoriaSpan = document.createElement("span");
                        categoriaSpan.textContent = compra.Categoria;  // Accediendo correctamente a la propiedad 'Categoria' del objeto 'compra'
                        div.appendChild(categoriaSpan);
                    
                        const productoLink = document.createElement("a");
                        productoLink.textContent = compra.producto_name;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
                        div.appendChild(productoLink);

                        resultadoConsulta.appendChild(div);
                        resultadoConsulta.appendChild(div2);
                    });
                
    
                }
            } catch(error) {
                // Se imprime el error del servidor
                console.error(xhr.response);
            }
            
        }
        xhr.send(JSON.stringify(data));


    }

}
