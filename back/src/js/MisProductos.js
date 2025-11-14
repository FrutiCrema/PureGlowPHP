document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("consulta-productos-form");
    const resultadoConsulta = document.getElementById("resultado-consulta");
    const categoriaSelect = document.getElementById("categoria");

    // Función para manejar la consulta de productos
    function consultarProductos(categoria) {
        // Realizar una solicitud al servidor para obtener los productos
        // Puedes utilizar AJAX o fetch para hacer esto

        console.log(categoria);


        let xhr = new XMLHttpRequest();

        xhr.open("POST", "../controllers/MisProductos.php", true); // true en modo asicrono
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




                    const resultadoConsulta = document.getElementById("resultado-consulta");
                    resultadoConsulta.innerHTML = "";
                
                    // Mostrar los resultados en el elemento resultadoConsulta

                    res.productos.forEach(compra => {
                
                        const div = document.createElement("div");
                        div.classList.add("product-info");
                    
                        const categoriaSpan = document.createElement("span");
                        categoriaSpan.textContent = compra.Categoria;  // Accediendo correctamente a la propiedad 'Categoria' del objeto 'compra'
                        div.appendChild(categoriaSpan);
                    
                        const productoLink = document.createElement("a");
                        productoLink.textContent = compra.producto_name;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
                        div.appendChild(productoLink);

                        const quantity = document.createElement("a");
                        quantity.textContent = 'Existen: ' + compra.producto_quantityAvailable;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
                        div.appendChild(quantity);

                        resultadoConsulta.appendChild(div);
                    });




                }
            } catch(error) {
                // Se imprime el error del servidor
                console.error(xhr.response);
            }
            
        }
        //Enviarlo en formato JSON
        xhr.send(JSON.stringify(categoria));


        // Aquí simularemos una solicitud con setTimeout
        setTimeout(() => {
            // Supongamos que recibimos los productos del servidor en formato JSON
            const productos = [
                { nombre: "Producto 1", categoria: "Categoría A" },
                { nombre: "Producto 2", categoria: "Categoría B" },
                { nombre: "Producto 3", categoria: "Categoría A" }
            ];

           

            
        }, 500); // Simular un tiempo de espera de 0.5 segundos
    }

    // Manejar el evento de envío del formulario
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe

        // Obtener el valor seleccionado de la categoría
        const categoriaSeleccionada = categoriaSelect.value;

        // Consultar productos para la categoría seleccionada
        consultarProductos(categoriaSeleccionada);
    });

    // Consultar todos los productos al cargar la página
    consultarProductos(null); // Pasa null para mostrar todos los productos
});
