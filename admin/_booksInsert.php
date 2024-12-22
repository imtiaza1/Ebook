<?php
include('partials/_header.php');
include('partials/_connection.php');

// code selct all categories name;
$selectCategories = "SELECT categories_name FROM categories";
$result = mysqli_query($con, $selectCategories);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and escape them
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $author = mysqli_real_escape_string($con, $_POST["author"]);
    $categories = mysqli_real_escape_string($con, $_POST["books_categories"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $price = mysqli_real_escape_string($con, $_POST["price"]);
    $format = mysqli_real_escape_string($con, $_POST["format"]);
    $shipping_info = mysqli_real_escape_string($con, $_POST["shipping_info"]);
    $subscription_details = mysqli_real_escape_string($con, $_POST["subscription_details"]);

    // File upload for book image
    $image_name = $_FILES["cover_image"]["name"];
    $image_tmp = $_FILES["cover_image"]["tmp_name"];
    $image_path = "../images/" . $image_name;
    // Move uploaded image to the desired directory
    move_uploaded_file($image_tmp, $image_path);

    // File upload for book PDF
    $pdf_name = $_FILES["pdf_document"]["name"];
    $pdf_tmp = $_FILES["pdf_document"]["tmp_name"];
    $pdf_path = "../files/" . $pdf_name;
    // Move uploaded file to the desired directory
    move_uploaded_file($pdf_tmp, $pdf_path);

    // Database insertion query with file paths (escaping variables in query to prevent SQL injection)
    $sql = "INSERT INTO books (title, books_categories, author, description, price, format, shipping_info, subscription_details, image, file, status) 
            VALUES ('$title', '$categories', '$author', '$description', '$price', '$format', '$shipping_info', '$subscription_details', '$image_path', '$pdf_path', '0')";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Insertion successful
        header('location: books.php');
    } else {
        // Insertion failed
        echo "Error: " . mysqli_error($con);
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
                    <li>
                        <a href="categories.php">
                            <i class="ri-function-line"></i><span>Books Category</span>
                        </a>
                    </li>
                    <li class="active active-menu">
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
                                <h4 class="card-title">Add Books</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Book Name:</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Book Author:</label>
                                    <input type="text" class="form-control" name="author">
                                </div>
                                <div class="form-group">
                                    <label>Book Category:</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="books_categories">
                                        <option selected="" disabled="">Book Category</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option><?php echo $row['categories_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Book Description:</label>
                                    <textarea class="form-control" rows="4" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Book Price:</label>
                                    <input type="text" class="form-control" name="price">
                                </div>
                                <div class="form-group">
                                    <label>Book Format:</label>
                                    <input type="text" class="form-control" name="format">
                                </div>
                                <div class="form-group">
                                    <label>Shipping Info:</label>
                                    <input type="text" class="form-control" name="shipping_info">
                                </div>
                                <div class="form-group">
                                    <label>Subscription Details:</label>
                                    <input type="text" class="form-control" name="subscription_details">
                                </div>
                                <div class="form-group">
                                    <label>Book Image:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/png, image/jpeg" name="cover_image">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Book PDF:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="application/pdf" name="pdf_document">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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