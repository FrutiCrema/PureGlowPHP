function Puntuacion() {
    var singleProduct = document.querySelector('.product-review');
    
    // Asegurarse de que singleProduct no esté vacío
    if (singleProduct) {
        var productId = singleProduct.querySelector('.product-id').value;
        var rating = singleProduct.querySelector('.rating-input').value;
        var comment = singleProduct.querySelector('.comment-box').value;

        // Crear el objeto producto
        var producto = {
            productId: productId,
            rating: rating,
            comment: comment
        };

        // Construir el objeto JSON con el producto
        var data = JSON.stringify({ producto: producto });

        // Enviar los datos mediante AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "../controllers/PuntuacionCotizacion.php", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            try {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    let res = JSON.parse(xhr.response);
                    console.log(res); // Imprimir el contenido de la variable res en la consola
                    if (res.success != true) {
                        alert(res.msg);
                        return;
                    }
                    // Success ...
                    alert(res.msg);
                    window.location.href = "http://localhost/PureGlow/back/src/views/landingPage.php";
                }
            } catch (error) {
                // Se imprime el error del servidor
                console.error(xhr.response);
            }
        };
        xhr.send(data);
    } else {
        alert("No se encontró ningún producto para calificar.");
    }
}
