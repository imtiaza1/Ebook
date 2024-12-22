<?php
include('partials/_header.php');
include('partials/_connection.php');


// Check if book ID is provided
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch book information from the database
    $query = "SELECT * FROM books WHERE book_id = '$book_id'";
    $result = mysqli_query($con, $query);

    // Check if the book exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch values safely
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $categories = $row["books_categories"];
        $author = $row['author'];
        $description = $row['description'];
        $price = $row['price'];
        $format = $row['format'];
        $shipping_info = $row['shipping_info'];
        $subscription_details = $row['subscription_details'];
        $image_path = $row['image'];
        $pdf_path = $row['file'];
    } else {
        header('location: books.php');
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $book_id = mysqli_real_escape_string($con, $_POST["book_id"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $categories = mysqli_real_escape_string($con, $_POST["books_categories"]);
    $author = mysqli_real_escape_string($con, $_POST["author"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $price = mysqli_real_escape_string($con, $_POST["price"]);
    $format = mysqli_real_escape_string($con, $_POST["format"]);
    $shipping_info = mysqli_real_escape_string($con, $_POST["shipping_info"]);
    $subscription_details = mysqli_real_escape_string($con, $_POST["subscription_details"]);
    // Check if a new image file is uploaded
    if ($_FILES["cover_image"]["size"] > 0) {
        // File upload for book image
        $image_name = $_FILES["cover_image"]["name"];
        $image_tmp = $_FILES["cover_image"]["tmp_name"];
        $image_path = "../images/" . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // No new image uploaded, keep the existing image path
        $image_path = $image_path;
    }

    // Check if a new PDF file is uploaded
    if ($_FILES["pdf_document"]["size"] > 0) {
        // File upload for book PDF
        $pdf_name = $_FILES["pdf_document"]["name"];
        $pdf_tmp = $_FILES["pdf_document"]["tmp_name"];
        $pdf_path = "files/" . $pdf_name;
        // Move uploaded file to the desired directory
        move_uploaded_file($pdf_tmp, $pdf_path);
    } else {
        // No new PDF uploaded, keep the existing PDF path
        $pdf_path = $_POST["current_pdf"];
    }

    // Database update query with file paths
    $sql = "UPDATE books SET title='$title', books_categories='$categories', author='$author', description='$description', price='$price', format='$format', shipping_info='$shipping_info', subscription_details='$subscription_details', image='$image_path', file='$pdf_path' WHERE book_id='$book_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Update successful
        header('location: books.php');
    } else {
        // Update failed
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
                                <h4 class="card-title">edit Books</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                <div class="form-group">
                                    <label>Book Name:</label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Book Author:</label>
                                    <input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Book Category:</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="books_categories">
                                        <option disabled>Book Category</option>
                                        <?php
                                        // select all categories name;
                                        $selectCategories = "SELECT categories_name FROM categories";
                                        $result = mysqli_query($con, $selectCategories);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $categoryName = $row['categories_name'];
                                            // Check if the current category matches $categories, if yes, mark it as selected
                                            $selected = ($categories == $categoryName) ? "selected" : "";
                                        ?>
                                            <option <?php echo $selected; ?>><?php echo $categoryName; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class=" form-group">
                                    <label>Book Description:</label>
                                    <textarea class="form-control" rows="4" name="description"><?php echo $description; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Book Price:</label>
                                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Book Format:</label>
                                    <input type="text" class="form-control" name="format" value="<?php echo $format; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Shipping Info:</label>
                                    <input type="text" class="form-control" name="shipping_info" value="<?php echo $shipping_info; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Subscription Details:</label>
                                    <input type="text" class="form-control" name="subscription_details" value="<?php echo $subscription_details; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Book Image:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/png, image/jpeg" name="cover_image">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <img src="<?php echo $image_path; ?>" alt="Book Image" class="img-fluid">
                                </div>
                                <div class="form-group">
                                    <label>Book PDF:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="application/pdf" name="pdf_document">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <a href="<?php echo $pdf_path; ?>" target="_blank">View PDF</a>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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