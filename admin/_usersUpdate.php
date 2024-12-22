<?php
include('partials/_header.php');
include('partials/_connection.php');
$passwordNotMatch = '';
$EmailError = '';

// Check if the 'user_id' parameter is set in the URL
if (isset($_GET['user_id'])) {
    // Get the user ID from the URL
    $user_id = $_GET['user_id'];

    // Prepare the SQL query to select user data based on user ID
    $sql = "SELECT * FROM users WHERE user_id=$user_id";

    // Execute the SQL query and store the result in $result
    $result = mysqli_query($con, $sql);

    // Fetch the first row of the result set as an associative array
    $row = mysqli_fetch_assoc($result);

    // Check if a row is found
    if ($row) {
        // Extract user details from the fetched row
        $name = $row['name'];
        $email = $row['email'];
        $image_path = $row['image'];
    } else {
        // If no row is found, redirect back to user.php
        header('location: user.php');
        exit(); // Terminate script execution
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    // Check if a new image file is uploaded
    if ($_FILES["image"]["size"] > 0) {
        // File upload for user image
        $image_name = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $image_path = "../images/" . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // No new image uploaded, keep the existing image path
        $sql = "SELECT image FROM users WHERE user_id='$user_id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['image'];
    }

    // Check if the email already exists in the database
    $selectEmail = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $selectEmail);
    $checkEmail = mysqli_num_rows($result);

    // If the email exists in the database
    if ($checkEmail > 0) {
        $row = mysqli_fetch_assoc($result);
        // Check if the email is associated with the current user being updated
        if ($row['user_id'] == $user_id) {
            $emailExists = false; // Email exists but for the same user, so it's okay to proceed with the update
        } else {
            $emailExists = true; // Email exists for another user, so we need to display an error message
        }
    } else {
        $emailExists = false; // Email doesn't exist in the database, so it's okay to proceed with the update
    }

    // If the email doesn't already exist in the database, proceed with the update
    if (!$emailExists) {
        // Update the user information in the database
        $sql = "UPDATE users SET name='$name', email='$email'";
        // Only include image update in the SQL query if a new image is uploaded
        if ($_FILES["image"]["size"] > 0) {
            $sql .= ", image='$image_path'";
        }
        $sql .= " WHERE user_id='$user_id'";

        $result = mysqli_query($con, $sql);

        // Check if the update was successful
        if ($result) {
            header('Location: user.php'); // Redirect to user.php after successful update
            exit();
        } else {
            echo "Error: Update query failed."; // Display an error message if the update fails
        }
    } else {
        // Display an error message if the email already exists in the database
        $EmailError = '
            <div class="alert alert-warning" role="alert">
                <div class="iq-alert-icon">
                    <i class="ri-alert-line"></i>
                </div>
                <div class="iq-alert-text"><b>Email</b> already exists!</div>
            </div>';
    }
}
?>
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
                    <li>
                        <a href="books.php"><i class="ri-file-pdf-line"></i><span>Books</span></a>
                    </li>
                    <li class="active active-menu">
                        <a href="user.php"><i class="las la-th-list"></i><span>Users</span></a>
                    </li>
                    <li class="">
                        <a href="competitions.php"><i class="fa-solid fa-trophy"></i><span>Competitions</span></a>
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
    <?php include('partials/_nav_bar.php'); ?>
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Edit Users</h4>
                            </div>
                            <?php echo $EmailError; ?>
                        </div>
                        <div class="iq-card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <div class="form-group">
                                    <label>User Name:</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label>User Email:</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Image:</label>
                                    <div class="custom-file" style="position: relative;">
                                        <input type="file" class="custom-file-input" accept="image/png, image/jpeg" name="image" value="">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <img src="<?php echo $image_path; ?>" alt="user Image" class="img-fluid img-thumbnail" style="display: block; margin-top: 10px;">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="user.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<?php include('partials/_footer.php'); ?>
<!-- Footer end-->