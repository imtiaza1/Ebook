<?php
include('partials/_header.php');
include('partials/_connection.php');
$passwordNotMatch = '';
$EmailError = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = mysqli_real_escape_string($con, trim($_POST['name']));
    $email    = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    // Check if email already exists
    $selectEmail = "SELECT * FROM users WHERE email='$email'";
    $sql = mysqli_query($con, $selectEmail);
    $checkEmail = mysqli_num_rows($sql);

    if ($checkEmail == 0) {
        if ($password === $cpassword) {
            // Hash the password correctly
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            // === Image upload ===
            $image_path = '';
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
                $image_name = basename($_FILES["image"]["name"]);
                $image_tmp  = $_FILES["image"]["tmp_name"];
                $image_path = "../images/" . uniqid() . "_" . $image_name;

                if (!move_uploaded_file($image_tmp, $image_path)) {
                    echo "<div class='alert alert-danger'>Image upload failed!</div>";
                    exit;
                }
            }

            // Insert into database
            $insertSql = "INSERT INTO users (image, name, email, password, registration_date) 
                          VALUES ('$image_path', '$name', '$email', '$hashPassword', current_timestamp())";

            if (mysqli_query($con, $insertSql)) {
                header('Location: user.php');
                exit;
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            // Passwords don't match
            $passwordNotMatch = '
            <div class="alert alert-danger" role="alert">
                <div class="iq-alert-icon">
                    <i class="ri-information-line"></i>
                </div>
                <div class="iq-alert-text"><b>Password</b> does not match!</div>
            </div>';
        }
    } else {
        // Email already exists
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
                                <h4 class="card-title">Add Users</h4>
                            </div>
                            <?php echo $passwordNotMatch; ?>
                            <?php echo $EmailError; ?>
                        </div>
                        <div class="iq-card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>User Name:</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label>user email:</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Image:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/png, image/jpeg" name="image">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>password:</label>
                                    <input type="text" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label>Conform password:</label>
                                    <input type="text" class="form-control" name="cpassword">
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