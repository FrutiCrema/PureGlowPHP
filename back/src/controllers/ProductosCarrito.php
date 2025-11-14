<?php
require_once "../database/db.php";

$mysqli = db::connect();

$idUser = $_SESSION["AUTH"]["user_id"];

$baseUrl = 'http://localhost/PureGlow/back/src/views';
$baseUrl2 = 'http://localhost/PureGlow/back/src/controllers';


// Crear la vista fuera del bloque de procedimiento
$sqlCreateView = "CREATE OR REPLACE VIEW `v_CargarCarrito` AS
    SELECT `ci`.`cartItem_quantity`, `ci`.`cartItem_idProduct`, `p`.`producto_name`, `p`.`producto_price`, `p`.`producto_quantityAvailable`, (
        SELECT `i`.`imagen_content`
        FROM `tb_image` `i`
        WHERE `i`.`imagen_idProducto` = `p`.`producto_id`
        LIMIT 1
    ) AS Contenido_imagen
    FROM `tb_cartitem` `ci`
    JOIN `tb_cart` `c` ON `c`.`carrito_id` = `ci`.`cartItem_idCart`
    JOIN `tb_product` `p` ON `ci`.`cartItem_idProduct` = `p`.`producto_id`
    WHERE `c`.`carrito_idUser` = $idUser";



// Ejecutar la consulta para crear la vista
if ($mysqli->query($sqlCreateView) === TRUE) {

    // Consulta SQL para obtener los datos de la vista
    $sqlSelectView = "SELECT `cartItem_quantity`, `cartItem_idProduct`, `producto_name`, `producto_price`, `producto_quantityAvailable`, `Contenido_imagen`
    FROM `v_CargarCarrito`";

    $result2 = $mysqli->query($sqlSelectView);

    if ($result2) {
        $productos = [];
        while ($row = $result2->fetch_assoc()) {
            $productos[] = $row;
        }
        $_SESSION["PRODUCTOS_CARRITO"] = $productos;

        // var_dump($_SESSION["PRODUCTOS_CARRITO"]);
    } else {
        echo "Error al obtener los datos de la vista: " . $mysqli->error;
    }

} else {
    // echo "Error al crear la vista: " . $conn->error;
}


// Ejecutar la consulta para obtener los datos de la vista
$result = $mysqli->query($sqlSelectView);

$total = 0;


echo '<form id="paymentForm" method="post" action="">';  // Formulario que engloba la tabla

if ($result->num_rows > 0) {
    $index = 1;
    while ($row = $result->fetch_assoc()) {
        $subtotal = $row["producto_price"] * $row["cartItem_quantity"];

        echo '<tr>';
        echo '<td>';
        echo '<div class="cart-info">';
        echo '<img src="' . $row["Contenido_imagen"] . '" alt="" />';
        echo '<div>';
        echo '<p>' . $row["producto_name"] . '</p>';
        echo '<span>Precio: $' . $row["producto_price"] . '</span> <br />';
        echo '<a href="#" id="eliminar-producto" onclick="eliminarProductoCarrito(event, ' . $row["cartItem_idProduct"] . ')">Eliminar</a>';
        echo '</div>';
        echo '</div>';
        echo '</td>';
        echo '<td><input type="number" name="quantity_' . $index . '" value="' . $row["cartItem_quantity"] . '" min="1" onchange="updateQuantity(' . $row["cartItem_idProduct"] . ', this.value)" /></td>';
        echo '<td> $'. $subtotal .'</td>';
        echo '</tr>';

        echo '<input type="hidden" name="item_name_' . $index . '" value="' . $row["producto_name"] . '">';
        echo '<input type="hidden" name="amount_' . $index . '" value="' . $row["producto_price"] . '">';

        $total += $subtotal;
        $index++;
    }    
    
    echo '</tbody>';
    echo '</table>';
    
    echo '<div class="total-price">';
    echo '<table>';
    echo '<tr>';
    echo '<td>Subtotal</td>';
    echo '<td>$'. $total .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Impuesto</td>';
    echo '<td>$'. $total * 0.16 .'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Total</td>';
    echo '<td>$'. $total * 1.16.'</td>';
    echo '</tr>';
    echo '</table>';
    echo '<button type="button" id="checkoutButton" class="checkout btn">Finalizar Compra</button>';

    echo '</div>';
    
    
    echo '<div id="paymentModal" class="modal">';
    echo '<div class="modal-content">';
    echo '<span class="close">&times;</span>';
    echo '<h2>¿Cómo desea pagar?</h2>';
    echo '<input type="radio" name="paymentMethod" value="creditCard" checked> Tarjeta de crédito/débito<br>';
    echo '<input type="radio" name="paymentMethod" value="paypal"> Paypal<br><br>';
    echo '<input type="hidden" name="total" value="'. $total * 1.16 .'">';
    echo '<input type="hidden" name="userId" value="'. $idUser .'">';
    echo '<button type="submit" class="btn">Continuar</button>';
    echo '</div>';
    echo '</div>';


    
    
    echo '</form>';
} else {
    echo '<tr>'; // Abre una nueva fila de la tabla para cada producto
    echo '<td>';
    echo '<div class="cart-info">';
    echo '<div>';
    echo '</div>';
    echo '</div>';
    echo '</td>';
    echo '<td></td>'; // Supongo que este es el precio unitario
    echo '</tr>'; // Cierra la fila de la tabla

    echo '</table>'; // Cierra la tabla

    echo '<div class="total-price">';
    echo '<table>';
    echo '<tr>';
    echo '<td>Subtotal</td>';
    echo '<td>$0</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Impuesto</td>';
    echo '<td>$0</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Total</td>';
    echo '<td>$0</td>';
    echo '</tr>';
    echo '</table>';
    echo '<button onclick="window.location.href="FinalizarCompra.php2" class="checkout btn">Finalizar Compra</button>';
    echo '</div>';
}

$sqlDeleteView = "DROP VIEW v_CargarCarrito";

$resultado = $mysqli->query($sqlDeleteView);



?>

<script src="/PureGlow/back/src/js/Carrito.js"></script>

<script>
document.getElementById("checkoutButton").onclick = function() {
  document.getElementById("paymentModal").style.display = "block";
};

document.querySelector(".close").onclick = function() {
  document.getElementById("paymentModal").style.display = "none";
};

window.onclick = function(event) {
  if (event.target == document.getElementById("paymentModal")) {
    document.getElementById("paymentModal").style.display = "none";
  }
};

document.getElementById("paymentForm").onsubmit = function(event) {

  const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
  if (paymentMethod === 'paypal') {
    this.action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    this.innerHTML += `
      <input type="hidden" name="business" value="sb-v6hkv30824429@business.example.com">
      <input type="hidden" name="image_url" value="https://picsum.photos/150/150">

      <input type="hidden" name="cmd" value="_cart">
      <input type="hidden" name="upload" value="1">
      <input type="hidden" name="currency_code" value="MXN">
      <!-- este es para la página que vamos a redireccionar una vez sea con éxito el pago  -->
      <input type="hidden" name="return" value="<?= $baseUrl ?>/receptor.php">
      <!-- y por si cancelan el pago a donde regresan -->
      <input type="hidden" name="cancel_return" value="<?= $baseUrl ?>/Carrito.php">
    `;
  } else {
    this.action = '/PureGlow/back/src/views/Tarjetas.php';
  }

  let index = 1;
  <?php
  $result->data_seek(0);
  while ($row = $result->fetch_assoc()) {
      $item_name = $row["producto_name"];
      $item_quantity = $row["cartItem_quantity"];
      $item_price = $row["producto_price"];
  ?>
  this.innerHTML += `
    <input type="hidden" name="item_name_${index}" value="<?php echo $item_name; ?>">
    <input type="hidden" name="quantity_${index}" value="<?php echo $item_quantity; ?>">
    <input type="hidden" name="amount_${index}" value="<?php echo $item_price; ?>">
  `;
  index++;
  <?php } ?>
};




function updateQuantity(productId, quantity) {

  const data = JSON.stringify({ productId: productId, quantity: quantity });

  let xhr = new XMLHttpRequest();


  xhr.open("POST", "../controllers/ActualizarCantidadCarrito.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onreadystatechange = function() {
    try {
      if (xhr.readyState == XMLHttpRequest.DONE && xhr.status === 200) {

        let res = JSON.parse(xhr.response);

        // Sucess ...
         alert(res.producto.message);

        // Aquí podrías actualizar la UI si es necesario
        location.reload(); // Recarga la página para actualizar el carrito

        // window.location.replace("http://localhost/PureGlow/back/src/views/Carrito.php");
      }
    }
    catch(error) {
      // Se imprime el error del servidor
      console.error(xhr.response);
    }
  };
  xhr.send(data);
}
</script>
