(function () { //Función IIFE
  
    let xhr = new XMLHttpRequest();
    
    xhr.open("POST", "../controllers/BuscarCategoria.php", true); // true para modo asincrónico
    xhr.onreadystatechange = function () {
        // Verifica si la solicitud se completó y se recibió una respuesta exitosa (estado 4 y estado 200)
        try {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let res = JSON.parse(xhr.responseText);
                    if (res.success !== true) {
                        console.error("La solicitud fue exitosa pero el servidor devolvió un error.");
                        return;
                    }
                    // Itera sobre las categorías recibidas del servidor y las agrega al elemento select
                    const selectElement = document.getElementById('categoria');
                    res.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.category_name;
                        option.textContent = category.category_name;
                        selectElement.appendChild(option);
                    });
                } else {
                    console.error("Error al realizar la solicitud: " + xhr.status);
                }
            }
        } catch (error) {
            // Se imprime el error del servidor
            console.error("Error en la respuesta del servidor:", error);
        }
    }
    
    xhr.send(); // Envía la solicitud
})();
