function Puntuacion() {
    var reviewElements = document.getElementsByClassName('product-review');
    var productos = [];

    for (var i = 0; i < reviewElements.length; i++) {
        var productId = reviewElements[i].querySelector('.product-id').value;
        var rating = reviewElements[i].querySelector('.rating-input').value;
        var comment = reviewElements[i].querySelector('.comment-box').value;

        // Agrega los datos de cada producto al arreglo de productos
        productos.push({
            productId: productId,
            rating: rating,
            comment: comment
        });
    }

    // Construye el objeto JSON con los productos
    var data = JSON.stringify({ productos: productos });

    // Envía los datos mediante AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/Puntuacion.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
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
        
};
    xhr.send(data);
}
