document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los elementos <li> con la clase "category-item"
    const categoryItems = document.querySelectorAll(".category-item");


    console.log(categoryItems);


    // Iterar sobre cada elemento y agregar un event listener de clic
    categoryItems.forEach(function(item) {
        item.addEventListener("click", function(event) {
            // Evitar que el clic en el enlace recargue la página
            event.preventDefault();

            // Obtener el ID del producto desde el atributo data-product-id
            const categoryId = this.getAttribute("data-product-id");


          const category = {
              id: categoryId,
          };

          console.log(categoryId);

        // Realizar una solicitud AJAX para agregar el producto al carrito
        const xhr = new XMLHttpRequest();

          xhr.open("POST", "../controllers/MostrarResultadoCategoria.php", true);
          xhr.setRequestHeader("Content-Type", "application/json");
          xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  // Hacer algo con la respuesta del controlador si es necesario
                  console.log(xhr.responseText);

                  let res = JSON.parse(xhr.response);

                // // Sucess ...
                // alert(res.msg);

                window.location.replace("http://localhost/PureGlow/back/src/views/ResultadosCategorias.php");


              }
          };
          xhr.send(JSON.stringify(category));
        });
    });
});
