
        function search() {
            const consulta = document.getElementById('searchInput').value.toLowerCase();
            const sortOption = document.getElementById('sortSelect').value;

            let xhr = new XMLHttpRequest();
            const busqueda = {
                consulta: consulta,
                sortOption: sortOption
            };



            xhr.open("POST", "../controllers/Busqueda.php", true); // true en modo asicrono
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
                        res.busqueda.forEach(compra => {
                    
                            console.log("ya entréeee")
                            const div = document.createElement("div");
                            div.classList.add("product-info");
                        
                            const categoriaSpan = document.createElement("span");
                            categoriaSpan.textContent = compra.Categoria;  // Accediendo correctamente a la propiedad 'Categoria' del objeto 'compra'
                            div.appendChild(categoriaSpan);
                        
                            const productoLink = document.createElement("a");
                            productoLink.textContent = compra.NombreProducto;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
                            div.appendChild(productoLink);
    
                            const quantity = document.createElement("a");
                            quantity.textContent = compra.Precio;  // Accediendo correctamente a la propiedad 'Producto' del objeto 'compra'
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
            xhr.send(JSON.stringify(busqueda));
        }
