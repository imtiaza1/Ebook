<?php
$cartAdd = false;
$cartAlreadyAdd = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-to-cart'])) {
  // Check if the cart session variable exists
  if (isset($_SESSION['cart'])) {
    $product_ids = array_column($_SESSION['cart'], 'product_id');
    // Check if the item is already in the cart
    if (in_array($_POST['product_id'], $product_ids)) {
      $cartAlreadyAdd = true;
      // Display Bootstrap alert for item already in cart
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Item Already Added!</strong> This item is already in your cart.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
      $count = count($_SESSION['cart']);
      $_SESSION['cart'][$count] = array(
        'product_id' => $_POST['product_id'], // Include product_id
        'item_name' => $_POST['item_name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'qty' => 1
      );
      // Display Bootstrap alert for successful addition
      echo '<div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Item Added!</strong> This item has been added to your cart.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
  } else {
    // If the cart session variable does not exist, create it and add the item
    $_SESSION['cart'][0] = array(
      'product_id' => $_POST['product_id'], // Include product_id
      'item_name' => $_POST['item_name'],
      'price' => $_POST['price'],
      'image' => $_POST['image'],
      'qty' => 1
    );
    // Display Bootstrap alert for successful addition (first item)
    echo '<div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Item Added!</strong> This item has been added to your cart.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  // Redirect the user back to the same page with a delay for alert visibility
  echo '<script>
          document.getElementById("successAlert").classList.add("show"); // Ensure alert is visible
          setTimeout(function() {
              window.location.href = "' . $_POST['redirect_url'] . '";
          }, 2000); // Redirect after 3 seconds (adjust as needed)
      </script>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['qty_mod'])) {
  foreach ($_SESSION['cart'] as $key => $value) {
    if ($value['item_name'] === $_POST['item-name']) {
      $new_quantity = $_POST['qty_mod'];
      // Update the session with the new quantity
      $_SESSION['cart'][$key]['qty'] = $new_quantity;
      break;
    }
  }
}
