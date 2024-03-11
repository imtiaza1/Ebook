<?php
include('includes/header.php');
include('includes/add-to-cart.php');
?>
<div class="page-content">
    <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm" style="background-image: url('images/background/bg3.jpg');">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <h1>Cart</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Cart
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

    <!-- inner page banner End-->

    <!-- contact area -->
    <section class="content-inner shop-account">
        <!-- Product -->
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table check-tbl">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Product name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th class="text-end">Close</th>
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
                                            <td class="product-item-price">$<?php echo $value['price']; ?></td>
                                            <td class="product-item-quantity">
                                                <!-- Display quantity -->
                                                <form method="post"> <!-- Update action with the PHP script to handle form submission -->
                                                    <input type="hidden" name="item-name" value="<?php echo $value['item_name']; ?>"> <!-- Hidden field to identify the item -->
                                                    <input type="number" min='1' max="10" name="qty_mod" value="<?php echo $value['qty']; ?>" data-price="<?php echo $value['price']; ?>" onchange="this.form.submit()"> <!-- onchange event to submit the form when quantity changes -->
                                                </form>

                                            </td>
                                            <!-- Display total price for each product -->
                                            <td class="product-item-total">$<?php echo number_format($total_price_per_product, 2); ?></td>
                                            <td class="product-item-close">
                                                <form method="post">
                                                    <input type="hidden" name="qty" value="<?php echo $value['qty']; ?>">
                                                    <button type="submit" name="remove-item" class="ti-close"><i class="fa-solid fa-x"></i></button>
                                                    <input type="hidden" name="item-name" value="<?php echo $value['item_name']; ?>">
                                                    <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <script>
                                function updateTotal(input) {
                                    var price = input.getAttribute('data-price');
                                    var quantity = input.value;
                                    var total = price * quantity;
                                    var row = input.parentNode.parentNode;
                                    var totalCell = row.querySelector('.product-item-total');
                                    totalCell.textContent = '$' + total.toFixed(2);
                                }
                            </script>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="form-group m-b25" style="text-align: center;">
                        <!-- Proceed to Checkout button -->
                        <a href="shop-checkout.php" class="btn btn-primary btnhover" type="button" name="submit">Proceed to Checkout</a>
                    </div>
                    <!-- Total section -->
                    <div class="total-section" style="text-align: center;">
                        <h4>Total: $<?php echo number_format($total, 2); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product END -->
    </section>
    <!-- contact area End-->
</div>
<?php
include('includes/footer.php');
?>