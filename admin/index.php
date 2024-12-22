<?php
// Require the header file which contains the common header elements
require('partials/_header.php');

// Include the file to establish a database connection
include('partials/_connection.php');

// Start the session to maintain user login state
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// Code to display the total count of books
$sql = "SELECT COUNT(*) AS total_books FROM books";
$result = mysqli_query($con, $sql);

// Check if the SQL query is executed successfully
if ($result) {
    // Fetch the total count of books from the result
    $row = mysqli_fetch_assoc($result);
    $total_books = $row['total_books'];
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($con);
}

// Code to display the total count of categories
$sql = "SELECT COUNT(*) AS total_categories FROM categories";
$result = mysqli_query($con, $sql);

// Check if the SQL query is executed successfully
if ($result) {
    // Fetch the total count of categories from the result
    $row = mysqli_fetch_assoc($result);
    $total_categories = $row['total_categories'];
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($con);
}

// Code to display the total count of users
$sql = "SELECT COUNT(*) AS total_users FROM users";
$result = mysqli_query($con, $sql);

// Check if the SQL query is executed successfully
if ($result) {
    // Fetch the total count of users from the result
    $row = mysqli_fetch_assoc($result);
    $total_users = $row['total_users'];
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($con);
}

// Code to display the total count of competitions
$sql = "SELECT COUNT(*) AS total_competitions FROM competitions";
$result = mysqli_query($con, $sql);

// Check if the SQL query is executed successfully
if ($result) {
    // Fetch the total count of competitions from the result
    $row = mysqli_fetch_assoc($result);
    $total_competitions = $row['total_competitions'];
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($con);
}

// Code to display the total count of orders
$sql = "SELECT COUNT(*) AS total_order FROM orders";
$result = mysqli_query($con, $sql);

// Check if the SQL query is executed successfully
if ($result) {
    // Fetch the total count of oders from the result
    $row = mysqli_fetch_assoc($result);
    $total_order = $row['total_order'];
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($con);
}

// Code to display the total count of sale
$sql = "SELECT SUM(total_price) AS total_sale FROM orders";
$result = mysqli_query($con, $sql);

// Check if the SQL query is executed successfully
if ($result) {
    // Fetch the total count of sale from the result
    $row = mysqli_fetch_assoc($result);
    $total_sale = round($row['total_sale']);
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($con);
}
?>


<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Sidebar  -->
    <div class="iq-sidebar">
        <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="index.html" class="header-logo">
                <img src="../images/logo.png" class="img-fluid rounded-normal" alt="">
            </a>
            <div class="iq-menu-bt-sidebar">
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="las la-bars"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu" id="admin" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                    <li class="active active-menu">
                        <a href="index.php" class="iq-waves-effect" data-toggle="collapse" aria-expanded="true">
                            <span class="ripple rippleEffect"></span>
                            <i class="las la-home iq-arrow-left"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="categories.php">
                            <i class="ri-function-line"></i><span>Books Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="books.php"><i class="ri-file-pdf-line"></i><span>Books</span></a>
                    </li>
                    <li class="">
                        <a href="user.php"><i class="las la-th-list"></i><span>Users</span></a>
                    </li>
                    <li class="">
                        <a href="competitions.php"><i class="fa-solid fa-trophy"></i><span>Competitions</span></a>
                    </li>
                    <li class="">
                        <a href="order.php"><i class="fa-brands fa-first-order"></i><span>Orders</span></a>
                    </li>
                    <li>
                        <a href="partials\_logout.php">
                            <i class="ri-login-box-line"></i><span>Sign-out</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- TOP Nav Bar -->
    <?php
    include('partials/_nav_bar.php');
    ?>
    <!-- TOP Nav Bar END -->
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle iq-card-icon bg-primary">
                                    <i class="ri-user-line"></i>
                                </div>
                                <div class="text-left ml-3">
                                    <h2 class="mb-0"><span class="counter"><?php echo $total_users; ?></span></h2>
                                    <h5 class="">Users</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle iq-card-icon bg-danger">
                                    <i class="ri-book-line"></i>
                                </div>
                                <div class="text-left ml-3">
                                    <h2 class="mb-0"><span class="counter"><?php echo $total_books ?></span></h2>
                                    <h5 class="">Books</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle iq-card-icon bg-warning">
                                    <i class="ri-shopping-cart-2-line"></i>
                                </div>
                                <div class="text-left ml-3">
                                    <h2 class="mb-0">$<span class="counter"><?php echo $total_sale; ?></span></h2>
                                    <h5 class="">Sale</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle iq-card-icon bg-info">
                                    <i class="ri-radar-line"></i>
                                </div>
                                <div class="text-left ml-3">
                                    <h2 class="mb-0"><span class="counter"><?php echo $total_order; ?></span></h2>
                                    <h5 class="">Orders</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle iq-card-icon bg-danger">
                                    <i class="ri-function-line"></i>
                                </div>
                                <div class="text-left ml-3">
                                    <h2 class="mb-0"><span class="counter"><?php echo $total_categories ?></span></h2>
                                    <h5 class="">categories</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle iq-card-icon bg-warning">
                                    <i class="fa-solid fa-trophy"></i>
                                </div>
                                <div class="text-left ml-3">
                                    <h2 class="mb-0"><span class="counter"><?php echo $total_competitions; ?></span></h2>
                                    <h5 class="">Competitions</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper END -->
<!-- Footer -->
<?php
include('partials/_footer.php');
?>
<!-- Footer end-->