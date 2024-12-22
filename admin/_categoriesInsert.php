<?php
include('partials/_header.php');
include('partials/_connection.php');


$error = false; // Initialize error flag as false
if (isset($_POST['submit'])) {
    $cname = mysqli_real_escape_string($con, $_POST['cname']);
    $cdesc = mysqli_real_escape_string($con, $_POST['cdesc']);

    // Check if category exists
    $selectcdesc = "SELECT * FROM categories WHERE categories_name='$cname'";
    $sql = mysqli_query($con, $selectcdesc);
    $checkcname = mysqli_num_rows($sql);
    if ($checkcname > 0) {
        $error = true; // Set error flag to true if category already exists
    } else {
        // Insert category if it does not exist
        $sql = "INSERT INTO categories (categories_name, categories_desc) VALUES ('$cname', '$cdesc')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            header('location: categories.php'); // Redirect to categories page on successful insertion
            exit(); // Terminate script execution after redirect
        } else {
            echo "Error: " . mysqli_error($con); // Output error message if insertion fails
        }
    }
}



?>
<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Sidebar  -->
    <div class="iq-sidebar">
        <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="index.php" class="header-logo">
                <img src="../images/logo.png" class="img-fluid rounded-normal" alt="" />
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
                    <li>
                        <a href="index.php">
                            <i class="las la-home iq-arrow-left"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="active active-menu">
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
                        <a href="compitions.php"><i class="fa-solid fa-trophy"></i><span>Competitions</span></a>
                    </li>
                    <li class="">
                        <a href="order.php"><i class="fa-brands fa-first-order"></i><span>Orders</span></a>
                    </li>
                    <li>
                        <a href="partials/_logout.php">
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
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Add Categories</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>Category Name:</label>
                                    <input type="text" name="cname" class="form-control">
                                    <?php
                                    // Handle error
                                    if ($error) {
                                        echo '
                                        <p class="text-danger">categories name already exits :(</p>
                                        '; // Output error message if category already exists
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Category Description:</label>
                                    <textarea class="form-control" rows="4" name="cdesc"></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </form>
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