<?php
require('includes/header.php');
require('includes/db.php');

<?php
$passwordNotMatch = false;
$EmailError = false;
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db_connection.php'; // Assuming you include DB connection here

    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Check if email already exists
    $selectEmail = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $selectEmail);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $checkEmail = mysqli_num_rows($result);

    if ($checkEmail == 0) {
        // Check if passwords match
        if ($password === $cpassword) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Handle image upload
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                $image_name = basename($_FILES["image"]["name"]);
                $image_tmp = $_FILES["image"]["tmp_name"];
                $image_path = "../images/" . $image_name;

                if (move_uploaded_file($image_tmp, $image_path)) {
                    // Insert user data into database
                    $insertQuery = "INSERT INTO users (image, name, email, password, registration_date) 
                                    VALUES (?, ?, ?, ?, current_timestamp())";
                    $stmt = mysqli_prepare($conn, $insertQuery);
                    mysqli_stmt_bind_param($stmt, "ssss", $image_path, $name, $email, $hashedPassword);

                    if (mysqli_stmt_execute($stmt)) {
                        $success = true;
                    } else {
                        $error = "Database insertion error: " . mysqli_error($conn);
                    }
                } else {
                    $error = "Failed to move uploaded file.";
                }
            } else {
                $error = "Image upload error.";
            }
        } else {
            $passwordNotMatch = true;
        }
    } else {
        $EmailError = true;
    }
}
?>



?>
<div class="page-content">
    <!-- inner page banner -->
    <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm" style="background-image:url(images/background/bg3.jpg);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Registration</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"> Home</a></li>
                        <li class="breadcrumb-item">Registration</li>
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
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="login-area">

                        <form method="post" enctype="multipart/form-data">
                            <h4 class="text-secondary">Registration</h4>
                            <p class="font-weight-600">If you don't have an account with us, please Registration.</p>
                            <div class="mb-4">
                                <label class="label-title">Username *</label>
                                <input name="username" required="" class="form-control" placeholder="Your Username" type="text">
                            </div>
                            <div class="mb-4">
                                <label class="label-title">Email address *</label>
                                <input name="email" required="" class="form-control" placeholder="Your Email address" type="email">

                            </div>
                            <div class="mb-4">
                                <label class="label-title">Password *</label>
                                <input name="password" required="" class="form-control" placeholder="Type Password" type="password">
                            </div>
                            <div class="mb-4">
                                <label class="label-title">Conform Password *</label>
                                <input name="cpassword" required="" class="form-control" placeholder="Type Password" type="password">
                            </div>
                            <div class="mb-4">
                                <label class="label-title">Profile Picture</label>
                                <input name="image" class="form-control" type="file">
                            </div>
                            <div class="mb-5">
                                <small>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="privacy-policy.html">privacy policy</a>.</small>
                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary btnhover w-100 me-2" name="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product END -->
    </section>
    <!-- contact area End-->
</div>
<?php
require('includes/footer.php')
?>
<?php if ($EmailError) {
?>
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Email already exists!",
        });
    </script>';
<?php
}
?>
<?php if ($passwordNotMatch) {
?>
    <script>
        Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "Password not match!",
        });
    </script>';
<?php
}
?>
<?php if ($success) {
?>
    <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Congratulations! Your account has been created successfully. Please login to continue.",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "login.php";
            }
        });
    </script>

<?php
}
?>