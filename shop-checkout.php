<?php
require('includes/header.php');
require('includes/db.php');
$success = false;
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<script>window.location.href="index.php";</script>';
    exit;
}

// require('stripe-php-master');
// $publishKey = "pk_test_51Oybaa2MoApc11ih9bZIeS0ZtCxeoyvKbUKTCGXksXRHeNUnYWeDX8O6DaLv1SovMvucNdjn6WEVKunavdgi8POW00xarZmRzg";
// $secretKey = "sk_test_51Oybaa2MoApc11ihu4a0N9IeryZPuyK8sIj8IsJZaQf4lzzbCFdnKAGkpYC46Rve4eYxuaHXLepg62V9rsNDZKqj00Beoh1Qh7";
// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve form data
//     $user_id = $_SESSION['user_id'];
//     $country = $_POST['country'];
//     $address = $_POST['address'];
//     $city = $_POST['city'];
//     $zipCode = $_POST['zip'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $paymentType = $_POST['cardType'];
//     // Initialize total price variable
//     $total = 0;
//     // Calculate total price for all products in the cart
//     foreach ($_SESSION['cart'] as $key => $value) {
//         $total_price_per_product = $value['price'] * $value['qty'];
//         $total += $total_price_per_product;
//     }
//     // Format the total price to 2 decimal places
//     $price = number_format($total, 2);
//     // SQL query to insert data into the database
//     $sql = "INSERT INTO Orders (user_id, Country, Address, City, ZipCode, Email, Phone, PaymentType, total_price, Status) 
//     VALUES ('$user_id', '$country', '$address', '$city', '$zipCode', '$email', '$phone', '$paymentType', '$price', 'Pending')";


//     // Execute the SQL statement
//     if (mysqli_query($conn, $sql)) {
//         // Retrieve the last inserted order ID
//         $order_id = mysqli_insert_id($conn);
//         // Loop through each item in the cart and insert into order_details table
//         foreach ($_SESSION['cart'] as $key => $value) {
//             $product_id = $value['product_id'];
//             $qty = $value['qty'];
//             $price = $value['price'];
//             $total_price = $qty * $price;
//             // Insert product details into order_details table
//             $insert_query = "INSERT INTO order_details (order_id, product_id, price, qty) 
//             VALUES ('$order_id', '$product_id', '$total_price','$qty')";
//             mysqli_query($conn, $insert_query);
//         }
//         // Display success message and redirect
//         echo '<script>
//         alert("Order placed successfully!");
//         window.location.href = "user_order.php";
//         </script>';

//         // Clear cart session
//         unset($_SESSION['cart']);
//     } else {
//         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//     }
//     // Close the database connection
//     mysqli_close($conn);
// }
?>
<?php

// Include the Stripe PHP library
require('stripe-php-master/init.php');

$publishKey = "pk_test_51Oybaa2MoApc11ih9bZIeS0ZtCxeoyvKbUKTCGXksXRHeNUnYWeDX8O6DaLv1SovMvucNdjn6WEVKunavdgi8POW00xarZmRzg";
$secretKey = "sk_test_51Oybaa2MoApc11ihu4a0N9IeryZPuyK8sIj8IsJZaQf4lzzbCFdnKAGkpYC46Rve4eYxuaHXLepg62V9rsNDZKqj00Beoh1Qh7";

// Set your secret key
Stripe\Stripe::setApiKey($secretKey);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_SESSION['user_id'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipCode = $_POST['zip'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $paymentType = $_POST['cardType'];

    // Initialize total price variable
    $total = 0;

    // Calculate total price for all products in the cart
    foreach ($_SESSION['cart'] as $key => $value) {
        $total_price_per_product = $value['price'] * $value['qty'];
        $total += $total_price_per_product;
    }

    // Check the selected payment method
    if ($paymentType === 'cod') {
        // If Cash on Delivery is selected, proceed without processing payment

        // Insertion into the database for COD payment
        $sql = "INSERT INTO Orders (user_id, Country, Address, City, ZipCode, Email, Phone, PaymentType, total_price, Status) 
                VALUES ('$user_id', '$country', '$address', '$city', '$zipCode', '$email', '$phone', '$paymentType', '$total', '0')";

        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
            $order_id = mysqli_insert_id($conn);
            // Loop through each item in the cart and insert into order_details table
            foreach ($_SESSION['cart'] as $key => $value) {
                $product_id = $value['product_id'];
                $qty = $value['qty'];
                $price = $value['price'];
                $total_price = $qty * $price;
                // Insert product details into order_details table
                $insert_query = "INSERT INTO order_details (order_id, product_id, price, qty) 
                    VALUES ('$order_id', '$product_id', '$total_price','$qty')";
                mysqli_query($conn, $insert_query);
            }
            // Display success message and redirect
            echo '<script>
                    alert("Order placed successfully!");
                    window.location.href = "user_order.php";
                </script>';
            unset($_SESSION['cart']);
            exit;
        } else {
            // Display error message if insertion fails
            echo '<script>alert("Error placing order. Please try again later.");</script>';
        }
    } elseif ($paymentType === 'stripe') {
        // If Stripe is selected, process the payment
        try {
            $charge = Stripe\Charge::create([
                'amount' => $total * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $_POST['stripeToken'], // Token from the client-side
                'description' => 'Order payment for user: ' . $user_id,
                // Add any additional parameters here if needed
            ]);

            // If charge is successful, proceed with inserting into the database
            $sql = "INSERT INTO Orders (user_id, Country, Address, City, ZipCode, Email, Phone, PaymentType, total_price, Status) 
                    VALUES ('$user_id', '$country', '$address', '$city', '$zipCode', '$email', '$phone', '$paymentType', '$total', '0')";

            // Execute the SQL statement
            if (mysqli_query($conn, $sql)) {
                // Retrieve the last inserted order ID
                $order_id = mysqli_insert_id($conn);
                // Loop through each item in the cart and insert into order_details table
                foreach ($_SESSION['cart'] as $key => $value) {
                    $product_id = $value['product_id'];
                    $qty = $value['qty'];
                    $price = $value['price'];
                    $total_price = $qty * $price;
                    // Insert product details into order_details table
                    $insert_query = "INSERT INTO order_details (order_id, product_id, price, qty) 
                    VALUES ('$order_id', '$product_id', '$total_price','$qty')";
                    mysqli_query($conn, $insert_query);
                }
                // Display success message and redirect
                echo '<script>
                    alert("Order placed successfully!");
                    window.location.href = "user_order.php";
                    </script>';

                // Clear cart session
                unset($_SESSION['cart']);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            // Close the database connection
            mysqli_close($conn);
        } catch (Stripe\Exception\CardException $e) {
            // Card was declined
            echo '<script>alert("Card was declined. Please try again.");</script>';
        } catch (Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            echo '<script>alert("Too many requests. Please try again later.");</script>';
        } catch (Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            echo '<script>alert("Invalid request. Please contact support.");</script>';
        } catch (Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            echo '<script>alert("Authentication failed. Please contact support.");</script>';
        } catch (Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            echo '<script>alert("Network error. Please try again later.");</script>';
        } catch (Stripe\Exception\ApiErrorException $e) {
            // Display a generic error if anything goes wrong
            echo '<script>alert("An error occurred. Please try again later.");</script>';
        }
    }
}
?>



<div class="page-content">
    <!-- inner page banner -->
    <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm" style="background-image:url(images/bg3.jpg);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Checkout</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> Home</a></li>
                        <li class="breadcrumb-item">Checkout</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- inner page banner End-->

    <!-- contact area -->
    <section class="content-inner-1">
        <!-- Product -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget">
                        <h4 class="widget-title">Your Order</h4>
                        <table class="table-bordered check-tbl">
                            <thead class="text-center">
                                <tr>
                                    <th>IMAGE</th>
                                    <th>PRODUCT NAME</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $key => $value) {
                                        // Calculate total price for each product based on quantity
                                        $total_price_per_product = $value['price'] * $value['qty'];
                                        // Update total for all products
                                        $total += $total_price_per_product;
                                ?>
                                        <tr>
                                            <td class="product-item-img"><img src="./images/<?php echo $value['image']; ?>" alt=""></td>
                                            <td class="product-item-name"><?php echo $value['item_name']; ?></td>
                                            <!-- Display total price for each product -->
                                            <td class="product-item-total">$<?php echo number_format($total_price_per_product, 2); ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="shop-form widget">
                        <h4 class="widget-title">Order Total</h4>
                        <table class="table-bordered check-tbl mb-4">
                            <tbody>
                                <tr>
                                    <td>Order Subtotal</td>
                                    <td class="product-price">$<?php echo number_format($total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>Free Shipping</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="product-price-total">$<?php echo number_format($total, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="dz-divider bg-gray-dark text-gray-dark icon-center  my-5"><i class="fa fa-circle bg-white text-gray-dark"></i></div>
            <form class="shop-form" method="post" id="payment-form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="widget">
                            <h4 class="widget-title">Billing &amp; Shipping Address</h4>
                            <div class="form-group">
                                <select class="default-select" name="country">
                                    <option value="pakistan">pakistan</option>
                                    <option value="australia">Australia</option>
                                    <option value="india">india</option>
                                    <option value="uk">uk</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Address" name="address" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="city" placeholder="Town / City" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="zip" placeholder="Postcode / Zip" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h4 class="widget-title">Payment Method</h4>
                        <div class="form-group">
                            <select class="default-select" name="cardType" id="cardType" required placeholder="payment type">
                                <option value="stripe">Credit Card</option>
                                <option value="cod">Cash on Delivery</option>
                            </select>
                        </div>

                        <div id="cardNumberField" class="form-group" style="display: none;">
                            <div id="card-element"></div>
                        </div>

                        <script>
                            // Get references to the select element and the card number field
                            var cardTypeSelect = document.getElementById('cardType');
                            var cardNumberField = document.getElementById('cardNumberField');

                            // Add event listener to the select element
                            cardTypeSelect.addEventListener('change', function() {
                                // Check if "Credit Card" option is selected
                                if (this.value === 'stripe') {
                                    // Display the card number field
                                    cardNumberField.style.display = 'block';
                                } else {
                                    // Hide the card number field
                                    cardNumberField.style.display = 'none';
                                }
                            });
                        </script>

                        <!-- <div id="card-element">Stripe Elements Placeholder</div> -->
                        <div class="form-group">
                            <button class="btn btn-primary btnhover" id="submitBtn" type="submit">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Product END -->
    </section>
    <!-- contact area End-->
</div>
<?php
require('includes/footer.php');

?>
<script>
    var stripe = Stripe('<?php echo $publishKey; ?>');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    var submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        submitBtn.disabled = true;

        var paymentType = document.getElementById('cardType').value;

        if (paymentType === 'stripe') {
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                    submitBtn.disabled = false;
                } else {
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);
                    form.submit();
                }
            });
        } else if (paymentType === 'cod') {
            form.submit();
        }
    });
</script>