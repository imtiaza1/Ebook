<?php
include('includes/header.php');
include('includes/add-to-cart.php');
?>
<div class="page-content">
    <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm" style="background-image:url(images/background/bg3.jpg);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>My Order's</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"> Home</a></li>
                        <li class="breadcrumb-item">Order</li>
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
                                    <th>Order id</th>
                                    <th>Order Date</th>
                                    <th>Address</th>
                                    <th>payment type</th>
                                    <th>payment status</th>
                                    <th>Order Detatil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $sql = mysqli_query($conn, "select * from orders where User_id=$user_id");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td class="product-item-img"><?php echo $row['OrderID']; ?></td>
                                        <td class="product-item-name"><?php echo $row['OrderDate']; ?></td>
                                        <td class="product-item-price">$<?php echo $row['Address']; ?></td>
                                        <td class="product-item-price"> <?php echo $row['PaymentType']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['Status'] == 1) {
                                            ?>
                                                <p style="color: #1ed760;"> Paid</p>
                                            <?php
                                            } else {
                                            ?>
                                                <p style="color: orange;"> pending</p>

                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="product-item-price">
                                            <a href="order_details.php?od=<?php echo $row['OrderID']; ?>" class="btn btn-primary btnhover" type="button" name="submit">Details</a>
                                        </td>
                                    </tr>
                                <?php
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