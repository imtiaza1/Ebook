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
    if (isset($_SESSION['user_id'])) {
        $user_id = intval($_SESSION['user_id']); // ✅ secure against SQL injection

        // Use prepared statement (safer)
        $stmt = mysqli_prepare($conn, "SELECT * FROM orders WHERE User_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <tr>
                <td class="product-item-img"><?php echo htmlspecialchars($row['OrderID']); ?></td>
                <td class="product-item-name"><?php echo htmlspecialchars($row['OrderDate']); ?></td>
                <td class="product-item-price">$<?php echo htmlspecialchars($row['Address']); ?></td>
                <td class="product-item-price"><?php echo htmlspecialchars($row['PaymentType']); ?></td>
                <td>
                    <?php if ($row['Status'] == 1): ?>
                        <p style="color: #1ed760;">Paid</p>
                    <?php else: ?>
                        <p style="color: orange;">Pending</p>
                    <?php endif; ?>
                </td>
                <td class="product-item-price">
                    <a href="order_details.php?od=<?php echo urlencode($row['OrderID']); ?>" class="btn btn-primary btnhover" type="button">Details</a>
                </td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='6'>User not logged in.</td></tr>";
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