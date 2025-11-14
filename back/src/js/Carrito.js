
function eliminarProductoCarrito(event, productId) {
    event.preventDefault(); // Evita el comportamiento predeterminado del enlace

    console.log("Eliminar producto con ID:", productId);

    // Realizar una solicitud AJAX para agregar el producto al carrito
    const xhr = new XMLHttpRequest();

    const cart = {
        idProducto: productId,
    };

    xhr.open("POST", "../controllers/RetirarProductoCarrito.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let res = JSON.parse(xhr.response);

            // Hacer algo con la respuesta del controlador si es necesario
            console.log(xhr.responseText);

            if(res.success != true)
            return;
            // Sucess ...
            alert(res.msg);
            window.location.replace("http://localhost/PureGlow/back/src/views/Carrito.php");

        }
    };
    xhr.send(JSON.stringify(cart));
    
}
