<?php
require('partials/_header.php');
include('partials/_connection.php');
$error = false;
// get categories
if (isset($_GET['id'])) {
    $categorieId = $_GET['id'];
    $selectCategories = "SELECT * FROM categories WHERE id='$categorieId'";
    $sql = mysqli_query($con, $selectCategories);

    // Check if category exists
    if (mysqli_num_rows($sql) > 0) {
        // Fetch category details
        $result = mysqli_fetch_assoc($sql);
        $categories_name = $result['categories_name'];
        $categories_desc = $result['categories_desc'];
    } else {
        // Handle case where category does not exist
        header('location: categories.php'); // Redirect to categories page on when categorie is't get;
    }
}

// Update category
if (isset($_POST['update'])) {
    $cname = isset($_POST['cname']) ? htmlspecialchars(trim($_POST['cname'])) : '';
    $cdesc = isset($_POST['cdesc']) ? htmlspecialchars(trim($_POST['cdesc'])) : '';

    // Validate category name
    if ($cname) {
        // Check if category name already exists (excluding the current category)
        $selectCategoriesName = "SELECT * FROM categories WHERE categories_name='$cname' AND id != '$categorieId'";
        $sql = mysqli_query($con, $selectCategoriesName);
        if (mysqli_num_rows($sql) > 0) {
            $error = true; // Set error flag to true if category name already exists
        } else {
            // Update category
            $updateQuery = "UPDATE categories SET categories_name='$cname', categories_desc='$cdesc' WHERE id='$categorieId'";
            $result = mysqli_query($con, $updateQuery);
            if ($result) {
                header('location: categories.php'); // Redirect to categories page on successful update
                exit(); // Terminate script execution after redirect
            } else {
                echo "Error: " . mysqli_error($con); // Output error message if update fails
            }
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
                                    <input type="text" name="cname" class="form-control" value="<?php echo $categories_name; ?>">
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
                                    <textarea class="form-control" rows="4" name="cdesc"><?php echo $categories_desc; ?></textarea>
                                </div>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
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
include('_footer.php');
?>
<!-- Footer end-->