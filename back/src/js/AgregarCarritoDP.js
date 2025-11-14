$(function () {
 
  $("#zoom").imagezoomsl({
    zoomrange: [4, 4],
  });
});

const heartIcon = document.getElementById("heartIcon");

heartIcon.addEventListener("click", function() {
  if (heartIcon.getAttribute("fill") === "#555") {
    heartIcon.setAttribute("fill", "blue");

    // Crear el diálogo y mostrarlo
    createDialog();
    showDialog();
  } else {
    heartIcon.setAttribute("fill", "#555");
    closeDialog();
  }
});





document.addEventListener('DOMContentLoaded', function() {
  // Selecciona todos los elementos con la clase 'addCart'
  const addCartButtons = document.querySelectorAll('.addCart');

  console

  // Agrega un evento 'click' a cada botón
  addCartButtons.forEach(function(button) {
      button.addEventListener('click', function(event) {
          event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

          // Obtener el ID del producto desde el atributo 'data-product-id'
          const productId = button.dataset.productId;

          let cantidadInput = document.getElementById('cantidadInput').value.trim();

          // Verificar si el input está vacío o no es un número
          if (cantidadInput === '' || isNaN(cantidadInput)) {
              // Si el input está vacío o no es un número válido, establecer la cantidad en 1
              cantidadInput = 1;
          } else {
              // Si el input es un número válido, convertirlo a un número entero
              cantidadInput = parseInt(cantidadInput);
          }

          // let errors = [];

          // if(!cantidadInput.value || !cantidadInput.value.trim()) {
          //     errors.push({ msg: "No se ha seleccionado la cantidad deseada." });
          // }
  
          // Hacer algo con el ID del producto y la cantidad (por ejemplo, agregarlo al carrito)
          console.log('ID del producto:', productId);
          console.log('Cantidad seleccionada por el usuario:', cantidadInput);


          // Realizar una solicitud AJAX para agregar el producto al carrito
          const xhr = new XMLHttpRequest();

          const product = {
              id: productId,
              quantityAvailable: cantidadInput
          };


          xhr.open("POST", "../controllers/AgregarAlCarrito.php", true);
          xhr.setRequestHeader("Content-Type", "application/json");
          xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  // Hacer algo con la respuesta del controlador si es necesario
                  console.log(xhr.responseText);
              }
          };
          xhr.send(JSON.stringify(product));
          
      });
  });
});






// Array para almacenar los nombres de favoritos seleccionados
// Array para almacenar los nombres de favoritos seleccionados
let favoritosSeleccionados = [];

function createDialog() {
  // Crear el overlay y el cuadro de diálogo
  const dialogOverlay = document.createElement("div");
  dialogOverlay.id = "dialog-overlay";

  const dialogBox = document.createElement("div");
  dialogBox.id = "dialog-box";

  const dialogContent = document.createElement("div");
  dialogContent.id = "dialog-content";

  // Texto del diálogo
  const dialogText = document.createElement("p");
  dialogText.textContent = "¿Deseas añadir este producto a favoritos?";

  // Select para mostrar las listas de favoritos
  const favoritesList = document.createElement("select");
  favoritesList.id = "favorite-lists";
  favoritesList.multiple = true;

  // Botón para agregar una nueva lista
  const addNewListBtn = document.createElement("button");
  addNewListBtn.textContent = "Agregar lista nueva";
  addNewListBtn.id = "add-new-list-btn";
  addNewListBtn.addEventListener("click", showAddListDialog);

  // Event listener para almacenar favoritos seleccionados
//   favoritesList.addEventListener("change", function() {
//     favoritosSeleccionados = [...this.selectedOptions].map(option => option.value); // Obtener el valor (ID) de cada opción seleccionada
//     console.log(favoritosSeleccionados); // Imprimir los IDs de las listas seleccionadas en la consola
// });

  // Botones de confirmación y cancelación
  const dialogButtons = document.createElement("div");
  dialogButtons.id = "dialog-buttons";

  const confirmBtn = document.createElement("button");
  confirmBtn.textContent = "Agregar";
  confirmBtn.id = "confirm-btn";

  const cancelBtn = document.createElement("button");
  cancelBtn.textContent = "Cancelar";
  cancelBtn.id = "cancel-btn";

  // Agregar elementos al contenido del diálogo
  dialogContent.appendChild(dialogText);
  dialogContent.appendChild(favoritesList);
  dialogContent.appendChild(addNewListBtn);
  dialogContent.appendChild(dialogButtons);
  dialogButtons.appendChild(confirmBtn);
  dialogButtons.appendChild(cancelBtn);



  // Agregar elementos al cuadro de diálogo
  dialogBox.appendChild(dialogContent);

  // Agregar elementos al overlay
  dialogOverlay.appendChild(dialogBox);

  // Agregar el overlay al cuerpo del documento
  document.body.appendChild(dialogOverlay);

  // Agregar eventos a los botones de confirmación y cancelación
  confirmBtn.addEventListener("click", function() {
    // Verificar si se ha seleccionado alguna lista
    if (favoritesList && favoritesList.options.length > 1) {
      const favoritosSeleccionados = [...favoritesList.selectedOptions].map(option => {
        console.log(option.value); // Aquí muestra cada valor antes de convertirlo
        return parseInt(option.value, 10);
      });
      console.log(favoritosSeleccionados);
  
      // Crear la solicitud AJAX usando XMLHttpRequest
      const xhr = new XMLHttpRequest();

      xhr.open("POST", "../controllers/GuardarProductoWishlist.php", true); // true en modo asicrono  
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
                window.location.href = "http://localhost/PureGlow/back/src/views/DetalleProducto.php";
            }
        } catch(error) {
            // Se imprime el error del servidor
            console.error(xhr.response);
        }
        
      }
      // Enviar la solicitud con los datos JSON
      xhr.send(JSON.stringify({ favoritos: favoritosSeleccionados }));

    } else {
      console.log("No se ha seleccionado ninguna lista de favoritos.");
    }
  });



  cancelBtn.addEventListener("click", function() {
      closeDialog();
  });

  // Realizar la solicitud AJAX para obtener las listas de favoritos
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../Controllers/TraerWishlists.php", true);
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
            // Limpiar las opciones existentes del select
          favoritesList.innerHTML = "";

          // Agregar cada lista de favoritos como una opción al select
          res.whistlist.forEach(function(list) {
              const option = document.createElement("option");
              option.textContent = list.lista_name;
              option.value = list.lista_id; // Si hay un ID asociado a la lista, puedes usarlo como valor
              favoritesList.appendChild(option);
          });
        }
    } catch(error) {
        // Se imprime el error del servidor
        console.error(xhr.response);
    }
  }
  xhr.send();
}

// Función para cerrar el diálogo
function closeDialog() {
  const dialogOverlay = document.getElementById("dialog-overlay");
  dialogOverlay.parentNode.removeChild(dialogOverlay);
}

// Función para mostrar el diálogo para agregar una nueva lista
function showAddListDialog() {
  // Implementa la lógica para mostrar el diálogo para agregar una nueva lista aquí
}



function showDialog() {
  document.getElementById("dialog-overlay").style.display = "flex";
}

function closeDialog() {
  const dialogOverlay = document.getElementById("dialog-overlay");
  if (dialogOverlay) {
    dialogOverlay.remove();
  }
}


function showAddListDialog() {
  const addListDialog = document.createElement("div");
  addListDialog.id = "add-list-dialog";

  const nameContainer = document.createElement("div"); // Contenedor para Nombre
  nameContainer.textContent = "Nombre:";
  nameContainer.style.paddingBottom = "5px"; // Aplicar padding
  nameContainer.style.paddingTop = "10px";

  const nameInput = document.createElement("input");
  nameInput.type = "text";
  nameInput.id = "list-name-input";
  nameInput.placeholder = "Nombre de la lista";

  nameContainer.appendChild(nameInput); // Agregar el input al contenedor

  const desContainer = document.createElement("div"); // Contenedor para Nombre
  desContainer.textContent = "Descripcion:";
  desContainer.style.paddingBottom = "5px"; // Aplicar padding
  desContainer.style.paddingTop = "10px";

  const descripcion = document.createElement("input");
  descripcion.type = "text";
  descripcion.id = "list-desc-input";
  descripcion.placeholder = "Descripción de la lista";

  desContainer.appendChild(descripcion); // Agregar el input al contenedor


  // Crear el checkbox "Pública"
  const publicCheckbox = document.createElement("input");
  publicCheckbox.type = "checkbox";
  publicCheckbox.id = "list-public-checkbox";
  publicCheckbox.checked = true; // Seleccionar por defecto

  const publicLabel = document.createElement("label");
  publicLabel.textContent = "Pública";

  // Agregar el checkbox y la etiqueta al contenedor
  nameContainer.appendChild(publicCheckbox);
  nameContainer.appendChild(publicLabel);
  nameContainer.appendChild(document.createElement("br")); // Añadir un salto de línea

  const addButton = document.createElement("button");
  addButton.textContent = "Agregar";
  addButton.id = "add-btn";
  addButton.addEventListener("click", addNewList);

  addListDialog.appendChild(nameContainer);
  addListDialog.appendChild(desContainer);
  addListDialog.appendChild(addButton);

  document.getElementById("dialog-overlay").appendChild(addListDialog);

  // Ocultar el botón "Agregar lista nueva"
  document.getElementById("add-new-list-btn").style.display = "none";
}

function addNewList() {
  const listNameInput = document.getElementById("list-name-input").value;
  const listDescInput = document.getElementById("list-desc-input").value;
  const isPublic = document.getElementById("list-public-checkbox").checked ? 1 : 0; // Convertir true en 1 y false en 2


  console.log(isPublic);


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
                // Sucess ...
                // alert(res.msg);
                window.location.href = "http://localhost/PureGlow/back/src/views/DetalleProducto.php";
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

    const favoritesList = document.getElementById("favorite-lists");

    const newList = document.createElement("option"); // Cambiado a 'option'
    newList.textContent = listNameInput;

    favoritesList.appendChild(newList);

    // Mostrar el botón "Agregar lista nueva"
    document.getElementById("add-new-list-btn").style.display = "block";

    // Eliminar el diálogo para agregar lista
    document.getElementById("add-list-dialog").remove();


  }





/*
DELIMITER //

CREATE PROCEDURE guardarListaDeseos(
  IN lista_name VARCHAR(255),
  IN lista_description TEXT,
  IN producto_id INT,
  IN usuario_id INT
)
BEGIN
  DECLARE v_lista_id INT;
  
  -- Insertar datos en la tabla de listas de deseos
  INSERT INTO tb_wishlist (lista_name, lista_description,  lista_idUser)
  VALUES (lista_name, lista_description, usuario_id);
  
  -- Obtener el ID de la lista de deseos recién creada
  SELECT LAST_INSERT_ID() INTO v_lista_id;
  
  -- Insertar la relación entre el producto y la lista de deseos
  INSERT INTO tb_productwishlist (listaProducto_idLista, listaProducto_idProducto)
  VALUES (v_lista_id, producto_id);
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE guardarProductoEnLista(
  IN producto_id INT,
  IN lista_name VARCHAR(255),
  IN pusuario_id INT
)
BEGIN
  DECLARE v_lista_id INT;

  -- Obtener el ID de la lista de deseos
  SELECT lista_id INTO v_lista_id
  FROM tb_wishlist
  WHERE lista_name = p_lista_name AND lista_idUser = p_usuario_id;

  -- Insertar la relación entre el producto y la lista de deseos
  IF v_lista_id IS NOT NULL THEN
      INSERT INTO tb_productwishlist (listaProducto_idLista, listaProducto_idProducto)
      VALUES (v_lista_id, p_producto_id);
  END IF;
END //

DELIMITER ;

*/