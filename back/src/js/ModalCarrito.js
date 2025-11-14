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
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="currency_code" value="MXN">
      `;
    } else {
      this.action = '<?php echo $baseUrl; ?>/receptor.php';
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