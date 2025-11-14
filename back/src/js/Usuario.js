





const templates = {
  perfil: `
  <h2>Perfil</h2>
  <div class="perfil-container">
    <img id="perfil-img" src="" alt="Foto de perfil">
        <div class="perfil-info">
        <p><strong>Usuario:</strong> <span id="username"></p>
        <p><strong>Nombre:</strong> <span id="fullname"></span></p>
          <p><strong>Correo:</strong> <span id="email"></span></p>
      </div>
  </div>`,


  configuracion: `
  <h2>Configuración</h2>
  <div id="configuracion">
      <br>
      <form id="formConfiguracion" action="" method="POST">
          <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="c_email" name="email">
        </div>
        <div>
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="c_username" name="username" minlength="3" required><br>
        </div>
          <div>
              <label for="password">Contraseña:</label>
              <input type="password" id="c_password" name="password">
          </div>
          
          <div>
              <label for="avatar">Imagen:</label><br>
              <input type="file" id="c_perfil-img" name="avatar" accept="image/*"><br>
          </div>
          <div>
              <label for="fullname">Nombre Completo:</label>
              <input type="text" id="c_fullname" name="fullname" required><br>
          </div>
          <div>
              <label for="birthdate">Fecha de nacimiento:</label>
              <input type="date" id="c_birthdate" name="birthdate" required><br>
          </div>
          <div>
              <label for="gender">Sexo:</label>
              <select id="c_rol" name="gender" required>
              <option value="male">Masculino</option>
              <option value="female">Femenino</option>
              <option value="other">Otro</option>
              </select><br>
          </div>
          <div>
              <button type="submit">Guardar cambios</button>
          </div>
      </form>
  </div>`,

  mensajes: `
  <h2>Mensajes</h2>
  <div id="chat-container">
      <div id="chats-list">
          <h3>Chats Disponibles</h3>
          <ul>
              <li>Chat 1</li>
              <li>Chat 2</li>
              <li>Chat 3</li>
              <!-- Agrega más chats según sea necesario -->
          </ul>
      </div>
      <div id="message-area">
          <h3>Chat Actual</h3>
          <div id="message-thread">
              <!-- Aquí se mostrarán los mensajes del chat seleccionado -->
          </div>
          <textarea id="message-input" placeholder="Escribe un mensaje..."></textarea>
          <button id="send-message-btn">Enviar</button>
      </div>
      <div id="product-info">
          <h3>Información del Producto</h3>
          <!-- Aquí se muestra la información del producto y del vendedor cuando se selecciona un chat -->
          <p>Nombre del Producto</p>
          <img src="../Imagenes/Tonico1.webp" alt="Producto">
          <p>Precio: $100</p>
          <p>Información del Vendedor</p>
          <button id="accept-button">Aceptar</button>
      </div>
  </div>`,

  pagos: `
  <h2>Métodos de pago</h2>
  <div class="card">
      <h2>Terminada en 9652</h2>
      <img src="../../front/Imagenes/visa.png" alt="Imagen 1">
      <p>VISA</p>
      <p>Vencimiento: 12/25</p>
  </div>

  <div class="card">
      <h2>Terminada en 5422</h2>
      <img src="../../front/Imagenes/mastercard.png" alt="Imagen 2">
      <p>Mastercard</p>
      <p>Vencimiento: 10/27</p>
  </div>`,

  wishlist: `
  <h2>Listas de Deseos</h2>
  <div id="wishlist">
      <!-- Lista por defecto -->
      <div class="wishlist-item">
          <span class="wishlist-name">Favoritos</span>
          <div class="wishlist-options">
              <button class="wishlist-edit">Editar</button>
              <button class="wishlist-delete">Eliminar</button>
          </div>
      </div>

      <div class="wishlist-item">
          <span class="wishlist-name">Cremas</span>
          <div class="wishlist-options">
              <button class="wishlist-edit">Editar</button>
              <button class="wishlist-delete">Eliminar</button>
          </div>

      </div>    

      <div class="wishlist-item">
          <span class="wishlist-name">Serums</span>
          <div class="wishlist-options">
              <button class="wishlist-edit">Editar</button>
              <button class="wishlist-delete">Eliminar</button>
          </div>
      </div>
  </div>
  <button id="add-wishlist">Agregar Lista Nueva</button>

  <!-- Diálogo para agregar nueva lista -->
  <div id="add-wishlist-dialog" class="hidden">
      <label for="new-wishlist-name">Nombre:</label>
      <input type="text" id="new-wishlist-name">
      <label for="wishlist-visibility">Visibilidad:</label>
      <select id="wishlist-visibility">
          <option value="public">Pública</option>
          <option value="private">Privada</option>
      </select>
      <button id="add-wishlist-btn">Agregar</button>
  </div>`,

  pedidos: `
  <h2>Pedidos</h2>
  <form id="consulta-compras-form">
      <label for="fecha-inicio">Fecha de inicio:</label>
      <input type="date" id="fecha-inicio" name="fecha-inicio">
      <label for="fecha-fin">Fecha de fin:</label>
      <input type="date" id="fecha-fin" name="fecha-fin">
      <label for="categoria">Categoría:</label>
      <select id="categoria" name="categoria">
          <option value="">Todas las categorías</option>
          <!-- Aquí puedes cargar dinámicamente las categorías desde la base de datos -->
          <option value="Electrónica">Electrónica</option>
          <option value="Ropa">Ropa</option>
          <option value="Hogar">Hogar</option>
          <!-- Agrega más opciones según las categorías disponibles -->
      </select>
      <button type="submit">Consultar</button>
  </form>
  
  <div id="resultado-consulta">
  <!-- Aquí se mostrarán los resultados de la consulta -->
  </div>

  <section class="section new-arrival">
      <div class="product-center">
      <div class="product-item">
        <div class="overlay">
          <a href="front/pages/DetalleProducto.html" class="product-thumb">
            <img src="../../front/Imagenes/Tonico1.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="front/pages/DetalleProducto.html">Tónico Facial Peach 77 Niacin Essence Toner
          </a>
          <h4>$700</h4>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/serum.jpg" alt="" />
          </a>            
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">La Roche-Posay Effaclar serum anti imperfecciones
          </a>
          <h4>$800</h4>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/balsamo facial.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">Bálsamo facial Collagen Vita Wrinkle Multi Balm</a>
          <h4>$150</h4>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/pons.jpg" alt="" />
          </a>         
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">Crema facial Pond's Antimanchas Clarant B3 200 g</a>
          <h4>$900</h4>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/serum2.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">The Ordinary Salicylic Acid 2% Solution (reformulado)</a>
          <h4>$100</h4>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>
  </section>
  `,

  misProductos: `
  <h2>Mis Productos</h2>
  <form id="consulta-productos-form">
      <label for="categoria">Categoría:</label>
      <select id="categoria" name="categoria">
          <option value="">Todas las categorías</option>
          <!-- Aquí puedes cargar dinámicamente las categorías desde la base de datos -->
          <option value="Electrónica">Electrónica</option>
          <option value="Ropa">Ropa</option>
          <option value="Hogar">Hogar</option>
          <!-- Agrega más opciones según las categorías disponibles -->
      </select>
      <button type="submit">Consultar</button>
  </form>
  
  <div id="resultado-consulta">
  <!-- Aquí se mostrarán los resultados de la consulta -->
  </div>

  <section class="section new-arrival">
      <div class="product-center">
      <div class="product-item">
        <div class="overlay">
          <a href="front/pages/DetalleProducto.html" class="product-thumb">
            <img src="../../front/Imagenes/Tonico1.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="front/pages/DetalleProducto.html">Tónico Facial Peach 77 Niacin Essence Toner
          </a>
          <h4>$700</h4>
          <p>Disponibles: </p>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/serum.jpg" alt="" />
          </a>            
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">La Roche-Posay Effaclar serum anti imperfecciones
          </a>
          <h4>$800</h4>
          <p>Disponibles: </p>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/balsamo facial.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">Bálsamo facial Collagen Vita Wrinkle Multi Balm</a>
          <h4>$150</h4>
          <p>Disponibles: </p>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/pons.jpg" alt="" />
          </a>         
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">Crema facial Pond's Antimanchas Clarant B3 200 g</a>
          <h4>$900</h4>
          <p>Disponibles: </p>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/serum2.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">The Ordinary Salicylic Acid 2% Solution (reformulado)</a>
          <h4>$100</h4>
          <p>Disponibles: </p>
        </div>
        <ul class="icons">
          <li><i class='bx bxs-show'></i></li>
        </ul>
      </div>
  </section>
  `,


  nuevoProducto: `
  <h2>Nuevo Producto</h2>
    <form id="nuevoProducto-form" onsubmit="return nuevoProductoForm()">
      <div>
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>
      <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
      </div>
      <div>
        <label for="imagenes">Imágenes (mínimo: 3):</label>
        <input type="file" id="imagenes" name="imagenes" accept="image/*" multiple required>
        <p id="mensaje-imagenes" style="display:none; color:red;">Selecciona al menos tres imágenes.</p>
      </div>
      <div>
        <label for="video">Video (mínimo: 1):</label>
        <input type="file" id="video" name="video" accept="video/*" required>
      </div>
      <div>
        <label for="categoria">Categoría (al menos una):</label>
        <select id="categoria" name="categoria" required>
          <option value="electronica">Electrónica</option>
          <option value="ropa">Ropa</option>
          <option value="hogar">Hogar</option>
          <!-- Agrega más opciones según sea necesario -->
        </select>
      </div>
      <div>
        <label for="tipo">¿Es para cotizar o para vender?</label>
        <select id="tipo" name="tipo" required>
          <option value="cotizar">Cotizar</option>
          <option value="vender">Vender</option>
        </select>
      </div>
      <div>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" min="0" step="0.01">
      </div>
      <div>
        <label for="cantidad">Cantidad disponible:</label>
        <input type="number" id="cantidad" name="cantidad" min="0">
      </div>
      <div>
        <button type="submit">Enviar</button>
      </div>
    </form>  
  `,



  ventas: `
  <h2>Ventas</h2>
  <form id="consulta-ventas-form">
      <label for="fecha_inicio">Fecha de inicio:</label>
      <input type="date" id="fecha_inicio" name="fecha_inicio">
      <label for="fecha_fin">Fecha de fin:</label>
      <input type="date" id="fecha_fin" name="fecha_fin">
      <label for="categoria">Categoría:</label>
      <select id="categoria" name="categoria">
          <option value="">Todas las categorías</option>
          <!-- Aquí puedes cargar dinámicamente las categorías desde la base de datos -->
          <option value="Electrónica">Electrónica</option>
          <option value="Ropa">Ropa</option>
          <option value="Hogar">Hogar</option>
          <!-- Agrega más opciones según las categorías disponibles -->
      </select>
      <button type="submit">Consultar</button>
  </form>
      
  <div id="resultado-consulta">
  <!-- Aquí se mostrarán los resultados de la consulta -->
  </div>

  <section class="section new-arrival">
      <div class="product-center">
      <div class="product-item">
        <div class="overlay">
          <a href="front/pages/DetalleProducto.html" class="product-thumb">
            <img src="../../front/Imagenes/Tonico1.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="front/pages/DetalleProducto.html">Tónico Facial Peach 77 Niacin Essence Toner
          </a>
          <h4>$700</h4>
        </div>   
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/serum.jpg" alt="" />
          </a>            
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">La Roche-Posay Effaclar serum anti imperfecciones
          </a>
          <h4>$800</h4>
        </div>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/balsamo facial.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">Bálsamo facial Collagen Vita Wrinkle Multi Balm</a>
          <h4>$150</h4>
        </div>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/pons.jpg" alt="" />
          </a>         
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">Crema facial Pond's Antimanchas Clarant B3 200 g</a>
          <h4>$900</h4>
        </div>
      </div>


      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="../../front/Imagenes/serum2.webp" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>CATEGORIA</span>
          <a href="">The Ordinary Salicylic Acid 2% Solution (reformulado)</a>
          <h4>$100</h4>
        </div>
      </div>
  </section>

  `,

  nuevoUsuario: `
  <h2>Nuevo administrador</h2>
  <div id="configuracion">
      <br>
        <form id="formConfiguracion" action="" method="POST">
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="email" id="NU_email" name="email" required><br>
            </div>
            <div>
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="NU_username" name="username" minlength="3" required><br>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="NU_password" name="password">
            </div>
            
            <div>
                <label for="avatar">Imagen:</label><br>
                <input type="file" id="NU_avatar" name="avatar" accept="image/*"><br>
            </div>
            <div>
                <label for="fullname">Nombre Completo:</label>
                <input type="text" id="NU_fullname" name="fullname" required><br>
            </div>
            <div>
                <label for="birthdate">Fecha de nacimiento:</label>
                <input type="date" id="NU_birthdate" name="birthdate" required><br>
            </div>
            <div>
                <label for="gender">Sexo:</label>
                <select id="NU_gender" name="gender" required>
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
                <option value="other">Otro</option>
                </select><br>
            </div>

              <label for="visibility">Visibilidad</label>
              <div>
                  <input type="radio" id="public" name="visibility" value="public" checked>
               <label for="public">Público</label>

               <input type="radio" id="private" name="visibility" value="private">
               <label for="private">Privado</label>
              </div>
            <div>
                <button type="submit">Registrar</button>
            </div>
        </form>
    </div>
    `,

    productosPendientes: `
    <h2>Productos pendientes</h2>   

    <section class="section new-arrival">
        <div class="product-center">
        <div class="product-item">
          <div class="overlay">
            <a href="front/pages/DetalleProducto.html" class="product-thumb">
              <img src="../../front/Imagenes/Tonico1.webp" alt="" />
            </a>
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="front/pages/DetalleProducto.html">Tónico Facial Peach 77 Niacin Essence Toner
            </a>
            <h4>$700</h4>
          </div>
          <div>
              <button type="submit">Admitir</button>
          </div>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/serum.jpg" alt="" />
            </a>            
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">La Roche-Posay Effaclar serum anti imperfecciones
            </a>
            <h4>$800</h4>
          </div>
          <div>
              <button type="submit">Admitir</button>
          </div>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/balsamo facial.webp" alt="" />
            </a>
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">Bálsamo facial Collagen Vita Wrinkle Multi Balm</a>
            <h4>$150</h4>
          </div>
          <div>
              <button type="submit">Admitir</button>
          </div>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/pons.jpg" alt="" />
            </a>         
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">Crema facial Pond's Antimanchas Clarant B3 200 g</a>
            <h4>$900</h4>
          </div>
          <div>
              <button type="submit">Admitir</button>
          </div>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/serum2.webp" alt="" />
            </a>
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">The Ordinary Salicylic Acid 2% Solution (reformulado)</a>
            <h4>$100</h4>
          </div>
          <div>
              <button type="submit">Admitir</button>
          </div>
        </div>
    </section>  
    `,

    productosAutorizados: `
    <h2>Productos autorizados</h2>
        
    <section class="section new-arrival">
        <div class="product-center">
        <div class="product-item">
          <div class="overlay">
            <a href="front/pages/DetalleProducto.html" class="product-thumb">
              <img src="../../front/Imagenes/Tonico1.webp" alt="" />
            </a>
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="front/pages/DetalleProducto.html">Tónico Facial Peach 77 Niacin Essence Toner
            </a>
            <h4>$700</h4>
          </div>
          <ul class="icons">
            <li><i class='bx bxs-show'></i></li>
          </ul>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/serum.jpg" alt="" />
            </a>            
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">La Roche-Posay Effaclar serum anti imperfecciones
            </a>
            <h4>$800</h4>
          </div>
          <ul class="icons">
            <li><i class='bx bxs-show'></i></li>
          </ul>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/balsamo facial.webp" alt="" />
            </a>
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">Bálsamo facial Collagen Vita Wrinkle Multi Balm</a>
            <h4>$150</h4>
          </div>
          <ul class="icons">
            <li><i class='bx bxs-show'></i></li>
          </ul>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/pons.jpg" alt="" />
            </a>         
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">Crema facial Pond's Antimanchas Clarant B3 200 g</a>
            <h4>$900</h4>
          </div>
          <ul class="icons">
            <li><i class='bx bxs-show'></i></li>
          </ul>
        </div>


        <div class="product-item">
          <div class="overlay">
            <a href="" class="product-thumb">
              <img src="../../front/Imagenes/serum2.webp" alt="" />
            </a>
          </div>
          <div class="product-info">
            <span>CATEGORIA</span>
            <a href="">The Ordinary Salicylic Acid 2% Solution (reformulado)</a>
            <h4>$100</h4>
          </div>
          <ul class="icons">
            <li><i class='bx bxs-show'></i></li>
          </ul>
        </div>
    </section>  
    `
};



// Función para mostrar contenido según la opción seleccionada
function mostrarContenido(opcion) {
  const contenido = document.getElementById('contenido');
  // Usa un switch para manejar cada opción de manera separada
  switch (opcion) {
      case 'configuracion':
          contenido.innerHTML = templates.configuracion;
          // Agrega lógica específica si es necesario
          break;
      case 'perfil':
          contenido.innerHTML = templates.perfil;
          // Agrega lógica específica si es necesario
          break;
      case 'mensajes':
          contenido.innerHTML = templates.mensajes;
          break;
      case 'pagos':
          contenido.innerHTML = templates.pagos;
          break;
      case 'wishlist':
          contenido.innerHTML = templates.wishlist;
          break;
      case 'pedidos':
          contenido.innerHTML = templates.pedidos;
          break;
      case 'misProductos':
        contenido.innerHTML = templates.misProductos;
        break;
      case 'nuevoProducto':
        contenido.innerHTML = templates.nuevoProducto;
        break;
      case 'ventas':
        contenido.innerHTML = templates.ventas;
        break;
      case 'nuevoUsuario':
          contenido.innerHTML = templates.nuevoUsuario;
          break;
      case 'productosPendientes':
          contenido.innerHTML = templates.productosPendientes;
          break;
      case 'productosAutorizados':
          contenido.innerHTML = templates.productosAutorizados;
          break;                                        
      default:
          // Manejar casos no reconocidos o genéricos
  }
}


// Agrega un solo manejador de eventos para toda la sección de perfil
document.getElementById('perfil').addEventListener('click', function(event) {
  const opcion = event.target.dataset.opcion;
  if (opcion) {
      mostrarDialogo(opcion);
  }
});


console.log(usuarioAutenticado);


if (usuarioAutenticado) {
  // Accede a los elementos del DOM por su ID
  var usernameElement = document.getElementById("username");
  //var fullnameElement = document.getElementById("fullname");
  var emailElement = document.getElementById("email");
  //var passwordElement = document.getElementById("password");
  //var rolElement = document.getElementById("rol");
  //var privacityElement = document.getElementById("privacity");
  //var genderElement = document.getElementById("gender");
  var imageElement = document.getElementById("perfil-img");
  //var birthdayElement = document.getElementById("birthdate");
  console.log("HOLA");

  // Asigna los valores del usuario a los elementos del DOM
  usernameElement.textContent = usuarioAutenticado.user_userName;
  //fullnameElement.textContent = usuarioAutenticado.user_name;
  emailElement.textContent = usuarioAutenticado.user_email;
  //passwordElement.textContent = usuarioAutenticado.user_password;
  //rolElement.textContent = usuarioAutenticado.user_rol;
  //privacityElement.textContent = usuarioAutenticado.user_isPublic;
  //genderElement.textContent = usuarioAutenticado.user_gender;
  imageElement.src = usuarioAutenticado.user_image;
  //birthdayElement.textContent = usuarioAutenticado.user_birthDate;
} else {
  console.log("No hay usuario autenticado");
  // Aquí puedes manejar el caso en el que no haya usuario autenticado
}


console.log(usuarioAutenticado);






function nuevoProductoForm() {
  var cantidadImagenes = document.getElementById('imagenes').files.length;
  if (cantidadImagenes < 3) {
    document.getElementById('mensaje-imagenes').style.display = 'block';
    return false; // Impide que el formulario se envíe
  }
  return true; // Permite que el formulario se envíe
}




const id =  JSON.parse(xhr.responseText);
let res = null;

xhr.open("POST", "../controllers/rolUser.php", true); // true en modo asicrono
xhr.onreadystatechange = function () {
    //Termina peticion 200 = OK
    try {
        if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)  {
            res = JSON.parse(xhr.response);
            console.log(res); // Imprimir el contenido de la variable res en la consola
            if(res.success != true) {
                alert(res.msg);
                return;
            }
            // Sucess ...
            alert(res.msg);
            //window.location.href = "http://localhost/PureGlow/back/src/views/landingPage.php";
        }
    } catch(error) {
        // Se imprime el error del servidor
        console.error(xhr.response);
    }
    
}
//Enviarlo en formato JSON
xhr.send(JSON.stringify(id));



 // Supongamos que 'rolUsuario' contiene el rol del usuario
 var rolUsuario = res; // Esto es un ejemplo, debes obtener el rol real del usuario

 // Función para mostrar/ocultar opciones según el rol del usuario
 function actualizarOpciones() {
     // Ocultar todas las opciones
     document.querySelectorAll('#opciones ul li').forEach(function(opcion) {
         opcion.style.display = 'none';
     });

     // Mostrar opciones según el rol del usuario
     switch (rolUsuario) {
         case '1': //Vendedor
             document.getElementById('perfil').style.display = 'block';
             document.getElementById('Configuración').style.display = 'block';
             document.getElementById('opcion3').style.display = 'block';
             break;
         case '2':
             document.getElementById('opcion1').style.display = 'block';
             break;
         // Agrega más casos según los roles que tengas
         default:
             // No hacer nada si el rol no coincide con ninguno de los casos anteriores
             break;
     }
 }

 // Llamar a la función para mostrar/ocultar opciones cuando se cargue la página
 actualizarOpciones();