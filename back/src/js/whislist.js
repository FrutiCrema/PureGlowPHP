function CrearWishlist(){

    const listNameInput = document.getElementById("list-name").value;
    const listDescInput = document.getElementById("list-desc").value;
    const isPublic = document.getElementById("wishlist-visibility").value; // Convertir true en 1 y false en 2
  
    
      const whishlist = {
        name: listNameInput,
        description: listDescInput,
        isPublicWL : isPublic
    };
  
      // Crear objeto XMLHttpRequest
      const xhr = new XMLHttpRequest();
  
      xhr.open("POST", "../controllers/AgregarWishlist.php", true); // true en modo asicrono
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
                //   Sucess ...
                  alert(res.msg);
                  window.location.href = "http://localhost/PureGlow/back/src/views/Wishlist.php";
              }
          } catch(error) {
              // Se imprime el error del servidor
              console.error(xhr.response);
          }
        }
      // // Obtener los datos del formulario para enviarlos como parámetros
      // const formData = "listName=" + encodeURIComponent(listNameInput) + "&listDesc=" + encodeURIComponent(listDescInput);
  
      // Enviar la solicitud con los datos del formulario
      xhr.send(JSON.stringify(whishlist));
  
  


}







function EliminarWishlist(productId){

  console.log("Producto ID:", productId);  
  
  
    const whishlist = {
      id: productId,
  };

    // Crear objeto XMLHttpRequest
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "../controllers/EliminarWishlist.php", true); // true en modo asicrono
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
              //   Sucess ...
                alert(res.msg);
                window.location.href = "http://localhost/PureGlow/back/src/views/Wishlist.php";
            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
      }
    // // Obtener los datos del formulario para enviarlos como parámetros
    // const formData = "listName=" + encodeURIComponent(listNameInput) + "&listDesc=" + encodeURIComponent(listDescInput);

    // Enviar la solicitud con los datos del formulario
    xhr.send(JSON.stringify(whishlist));
}






function openEditModal(idWishlist) {
  // Insertar el contenido del modal en el contenedor


  const wishlist = {
    id: idWishlist
  };

  // Crear objeto XMLHttpRequest
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../controllers/InfoWishlit.php", true);
  xhr.onreadystatechange = function () {
    //Termina peticion 200 = OK
    try {
        if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
          const wishlistData = JSON.parse(xhr.responseText);

          console.log(wishlistData); // Imprimir el contenido de la variable res en la consola

          if(wishlistData.success != true) {
              alert(wishlistData.msg);
              
          }
        
          
          // Procesar los datos si es necesario
          wishlistData.info.forEach(function(product) {
            // Aquí puedes realizar cualquier procesamiento adicional necesario para cada producto
            // Por ejemplo, dar formato a los precios, agregar nuevas propiedades, etc.
          });
          populateModal(wishlistData.info, idWishlist);
        }
    } catch(error) {
        // Se imprime el error del servidor
        console.error(xhr.response);
    }
    
  }
  xhr.send(JSON.stringify(wishlist));
}


function populateModal(wishlistData, idWishlist) {
  // Insertar el contenido del modal en el contenedor
  document.getElementById("modalContainer").innerHTML = `
    <div id="editModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        
        <h2>Editar Wishlist</h2>
        
        <form id="editWishlistForm">
          <input type="hidden" id="edit-product-id" value="${wishlistData[0].lista_name}">
          <label for="list-name">Nombre de la lista:</label>
          <input type="text" id="edit-list-name" name="list-name" value="${wishlistData[0].lista_name}">
          
          <div>
            <label for="list-desc">Descripción de la lista:</label>
            <input type="text" id="edit-list-desc" name="list-desc" value="${wishlistData[0].lista_description}">
          </div>
          <br>
          
          <label for="wishlist-visibility">Visibilidad:</label>
          <select id="edit-wishlist-visibility" name="wishlist-visibility">
            <option value="1" ${wishlistData[0].lista_isPublic === 1 ? 'selected' : ''}>Público</option>
            <option value="0" ${wishlistData[0].lista_isPublic === 0 ? 'selected' : ''}>Privado</option>
          </select>
          
          <h3>Productos:</h3>
          <ul id="wishlist-products">
            ${wishlistData.map(product => `
              <li>
                <strong>${product.producto_name}</strong>: ${product.producto_description}
              </li>
            `).join('')}
          </ul>
          
          <button type="button" onclick="submitEditForm(${idWishlist})">Guardar cambios</button>

        </form>
      </div>
    </div>
  `;

  // Mostrar el modal
  document.getElementById("editModal").style.display = "block";
}

// Cerrar el modal
function closeEditModal() {
  document.getElementById("editModal").style.display = "none";
  document.getElementById("modalContainer").innerHTML = ""; // Limpiar el contenido del modal
}

// Enviar el formulario con los datos editados
function submitEditForm(idWishlist) {
  const listNameInput = document.getElementById("edit-list-name").value;
  const listDescInput = document.getElementById("edit-list-desc").value;
  const isPublic = document.getElementById("edit-wishlist-visibility").value;

  const wishlist = {
    idWishlist: idWishlist,
    name: listNameInput,
    description: listDescInput,
    isPublicWL: isPublic
  };

  // Crear objeto XMLHttpRequest
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../controllers/EditarWishlist.php", true);
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
            window.location.href = "http://localhost/PureGlow/back/src/views/Wishlist.php";
        }
    } catch(error) {
        // Se imprime el error del servidor
        console.error(xhr.response);
    }
    
  }
  xhr.send(JSON.stringify(wishlist));
}
