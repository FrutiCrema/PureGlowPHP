(function () { //Function IIFE

  

  const imagenes = document.getElementById("imagenes");
  const videoInput = document.getElementById("video"); // Obtener el input de tipo file para el video

  

 // $archivo_tmp = $_FILES["video"]["tmp_name"];
  //$archivo_type = $_FILES["archivo"]["type"];

  let base64Imagenes = [];
  let videoFileName = null;
  let videoFilePath = null; // Variable para almacenar la ruta del archivo de video
  let videoFile = null;

  // Escuchar el evento change en el input de tipo file para las imágenes
  imagenes.addEventListener('change', function() {
      // Reiniciar el arreglo de imágenes cada vez que se selecciona un nuevo conjunto de imágenes
      base64Imagenes = [];
      // Verificar si se seleccionaron archivos
      if (imagenes.files && imagenes.files.length > 0) {
          // Iterar sobre cada archivo seleccionado
          for (let i = 0; i < imagenes.files.length; i++) {
              const lector = new FileReader();
              lector.onload = function(evento) {
                  base64Imagenes.push(evento.target.result);
              };
              lector.readAsDataURL(imagenes.files[i]);
          }
      }
      console.log(base64Imagenes);
  });

// Escuchar el evento change en el input de tipo file para el video
videoInput.addEventListener('change', function() {
    // Verificar si se seleccionó un archivo de video
    if (videoInput.files && videoInput.files.length > 0) {
        // Guardar el archivo de video seleccionado
        videoFile = videoInput.files[0];
        // Guardar el nombre del archivo de video seleccionado
        videoFileName = videoInput.files[0].name;
        // Obtener la ruta del archivo (en este caso, solo el nombre del archivo)
        videoFilePath = videoFileName;
        console.log(videoFilePath);
        console.log(videoFile);
    }
});
  //console.log($archivo_tmp);

  const formSignup = document.getElementById("nuevoProducto-form");

  formSignup.onsubmit = function (e) {
      //Quitar submit
      e.preventDefault();

      const iName  =document.getElementById("nombre");
      const iDescription  =document.getElementById("descripcion");
      const iCategory = document.getElementById("categoria");

      // Obtener el índice de la opción seleccionada
      const selectedIndex = iCategory.selectedIndex;

      // Obtener el texto de la opción seleccionada
      const selectedOptionText = iCategory.options[selectedIndex].text;

      const iType = document.getElementById("opciones");   //Saber si es cotización
      const iPrice = document.getElementById("precio");
      const iQuantity = document.getElementById("mucho");


      let errors = [];

      if(!iName.value || !iName.value.trim()) {
          errors.push({ msg: "Campo de nombre del producto está vacío." });
      }
      if(!iDescription.value || !iDescription.value.trim()) {
          errors.push({ msg: "Campo de descripción está vacío." });
      }
      

      if(selectedOptionText == "Vender")
      {
        if(!iPrice.value || !iPrice.value.trim()) {
            errors.push({ msg: "Campo de precio está vacío." });
        }

        if(!iQuantity.value || !iQuantity.value.trim()) {
            errors.push({ msg: "Campo de cantidad está vacío." });
        }
  
      }

      if(errors.length) {
          alert(JSON.stringify(errors));
          return;
      }



      let formData = new FormData();

      const product = {
          name: iName.value.trim(),
          description: iDescription.value.trim(),
          category: selectedOptionText,
          quotation: iType.value,
          price: iPrice.value,
          quantityAvailable: iQuantity.value,
          image: base64Imagenes,
      };

      formData.append('json', JSON.stringify(product));

      if (videoFile) {
          formData.append('video', videoFile);
      }


      let xhr = new XMLHttpRequest();

      xhr.open("POST", "../controllers/NuevoProducto.php", true); // true en modo asicrono
      xhr.onreadystatechange = function () {
          //Termina peticion 200 = OK
          try {
              if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
                  let res = JSON.parse(xhr.response);
                  if(res.success != true)
                      return;
                  // Sucess ...
                  alert(res.msg);
                  window.location.replace("http://localhost/PureGlow/back/src/views/NuevoProducto.php");
              }
          } catch(error) {
              // Se imprime el error del servidor
              console.error(xhr.response);
          }
          
      }
      //Enviarlo en formato JSON
      xhr.send(formData);
  }
})();




function checkTipo() {
  var tipoSeleccionado = document.getElementById('opciones').value;
  if (tipoSeleccionado === '2') {
    document.getElementById('precio').disabled = true;
    document.getElementById('mucho').disabled = true;
  } else {
    document.getElementById('precio').disabled = false;
    document.getElementById('mucho').disabled = false;
  }
}


function nuevoProductoForm() {
  var cantidadImagenes = document.getElementById('imagenes').files.length;
  var cantidadVideos = document.getElementById('video').files.length;

  if (cantidadImagenes !== 3) {
      document.getElementById('mensaje-imagenes').style.display = 'block';
      return false; // Impide que el formulario se envíe
  }

  if (cantidadVideos !== 1) {
      document.getElementById('mensaje-video').style.display = 'block';
      return false; // Impide que el formulario se envíe
  }

  return true; // Permite que el formulario se envíe
}
