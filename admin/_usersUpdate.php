<?php
include('partials/_header.php');
include('partials/_connection.php');
$passwordNotMatch = '';
$EmailError = '';

// ======== 1. FETCH USER DATA ========
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']); // cast to int for safety

    $result = mysqli_query($con, "SELECT * FROM users WHERE user_id = $user_id");
    if ($row = mysqli_fetch_assoc($result)) {
        $name       = $row['name'];
        $email      = $row['email'];
        $image_path = $row['image'];
    } else {
        header('Location: user.php');
        exit;
    }
}

// ======== 2. UPDATE USER DATA ========
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $name    = mysqli_real_escape_string($con, trim($_POST['name']));
    $email   = mysqli_real_escape_string($con, trim($_POST['email']));

    // === Image Upload Logic ===
    if (isset($_FILES["image"]) && $_FILES["image"]["size"] > 0 && $_FILES["image"]["error"] === 0) {
        $image_name = basename($_FILES["image"]["name"]);
        $image_tmp  = $_FILES["image"]["tmp_name"];
        $image_path = "../images/" . uniqid() . "_" . $image_name;

        if (!move_uploaded_file($image_tmp, $image_path)) {
            echo "<div class='alert alert-danger'>Image upload failed!</div>";
            exit;
        }
    } else {
        // Keep the old image
        $imgRes = mysqli_query($con, "SELECT image FROM users WHERE user_id = '$user_id'");
        $imgRow = mysqli_fetch_assoc($imgRes);
        $image_path = $imgRow['image'] ?? '';
    }

    // === Email Uniqueness Check ===
    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email' AND user_id != '$user_id'";
    $emailCheckRes = mysqli_query($con, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckRes) > 0) {
        $EmailError = '
        <div class="alert alert-warning" role="alert">
            <div class="iq-alert-icon">
                <i class="ri-alert-line"></i>
            </div>
            <div class="iq-alert-text"><b>Email</b> already exists!</div>
        </div>';
    } else {
        // === Run the Update Query ===
        $updateSql = "
            UPDATE users SET
            name = '$name',
            email = '$email',
            image = '$image_path'
            WHERE user_id = '$user_id'
        ";

        if (mysqli_query($con, $updateSql)) {
            header('Location: user.php');
            exit;
        } else {
            echo "<div class='alert alert-danger'>Update failed: " . mysqli_error($con) . "</div>";
        }
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