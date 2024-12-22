<?php
include('includes/header.php');
include('includes/db.php');
include('includes/add-to-cart.php');
?>
<div class="page-content">
    <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm" style="background-image:url(images/background/bg3.jpg);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Order Detatils</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"> Home</a></li>
                        <li class="breadcrumb-item">Order-details</li>
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
                                    <th>Product image</th>
                                    <th>Product name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>

                            </thead>
                            <tbody>

                                <?php
                                if (isset($_GET['od'])) {
                                    $user_id = $_SESSION['user_id'];
                                    $order_id = $_GET['od'];
                                    $sql = mysqli_query($conn, "SELECT DISTINCT od.id, od.*, b.title, b.image, b.price 
                                    FROM order_details od
                                    JOIN books b ON od.product_id = b.book_id
                                    JOIN orders o ON od.order_id = o.OrderID
                                    WHERE od.order_id = '$order_id' 
                                    AND o.User_id = '$user_id'");
                                    if (mysqli_num_rows($sql) > 0) {
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                            <tr>
                                                <td class="product-item-img"><img src="./images/<?php echo $row['image']; ?>" alt=""></td>
                                                <td class="product-item-name"><?php echo $row['title']; ?></td>
                                                <td class="product-item-price">$<?php echo $row['price']; ?></td>
                                                <td class="product-item-quantity"><?php echo $row['qty']; ?></td>
                                                <td class="product-item-price">$<?php echo $row['qty'] * $row['price']; ?></td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                        echo "No order details found.";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact area End-->
</div>
<?php
include('includes/footer.php');
?>