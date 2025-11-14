document.addEventListener("DOMContentLoaded", function() {
  // Obtener todos los íconos con la clase "bx" y "bx-cart"
  const carritoIcons = document.querySelectorAll(".bx.bxs-show");
  const carritoname = document.querySelectorAll(".bx.bx-name");


  // Iterar sobre cada ícono y agregar un evento clic
  carritoIcons.forEach(function(icon) {
      icon.addEventListener("click", function() {
          // Obtener el ID del producto desde el atributo data-product-id
          const productId = this.getAttribute("data-product-id");

          // Realizar una solicitud AJAX para agregar el producto al carrito
          const xhr = new XMLHttpRequest();

          const product = {
              id: productId,
          };

          console.log(productId);

          xhr.open("POST", "../controllers/MostrarDetalleProducto.php", true);
          xhr.setRequestHeader("Content-Type", "application/json");
          xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  // Hacer algo con la respuesta del controlador si es necesario
                  console.log(xhr.responseText);

                  let res = JSON.parse(xhr.response);

                // // Sucess ...
                // alert(res.msg);

                window.location.replace("http://localhost/PureGlow/back/src/views/DetalleProducto.php");


              }
          };
          xhr.send(JSON.stringify(product));
      });
  });

});















