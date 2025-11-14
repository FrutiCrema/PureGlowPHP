document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los íconos con la clase "bx" y "bx-cart"
    const carritoIcons = document.querySelectorAll(".bx.bx-cart");

    // Iterar sobre cada ícono y agregar un evento clic
    carritoIcons.forEach(function(icon) {
        icon.addEventListener("click", function() {
            // Obtener el ID del producto desde el atributo data-product-id
            const productId = this.getAttribute("data-product-id");

            // Realizar una solicitud AJAX para agregar el producto al carrito
            const xhr = new XMLHttpRequest();

            const product = {
                id: productId,
                quantityAvailable: 1
            };

            console.log(productId);

            xhr.open("POST", "../controllers/AgregarAlCarrito.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
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
                        return;
                    }
                } catch(error) {
                    // Se imprime el error del servidor
                    console.error(xhr.response);
                }
                
            };
            xhr.send(JSON.stringify(product));
        });
    });
});
