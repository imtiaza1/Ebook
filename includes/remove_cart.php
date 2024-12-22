<?php
if (isset($_POST['remove-item'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['item_name'] == $_POST['item-name']) { // Fix: Use $value['item_name']

            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            echo '<script>window.location.href = "' . $_POST['redirect_url'] . '";</script>';
        }
    }
}
