<?php
require('includes/header.php');
require('includes/db.php');

$passwordNotMatch = false;
$EmailError = false;
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Check if email already exists
    $selectEmail = "SELECT * FROM users WHERE email='$email'";
    $sql = mysqli_query($conn, $selectEmail);
    $checkEmail = mysqli_num_rows($sql);

    if ($checkEmail == 0) {
        // Check if passwords match
        if ($password === $cpassword) {
            // Hash the password securely
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // File upload for user image
            $image_name = $_FILES["image"]["name"];
            $image_tmp = $_FILES["image"]["tmp_name"];
            $image_path = "../images/" . $image_name;
            // Move uploaded image to the desired directory
            move_uploaded_file($image_tmp, $image_path);

            // Database entries
            $sql = "INSERT INTO `users` (`image`, `name`, `email`, `password`, `registration_date`) 
            VALUES ('$image_path', '$name', '$email', '$hashedPassword', current_timestamp())";

            // Execute the query
            if (mysqli_query($conn, $sql)) {
                // Insertion successful
                $success = true;
            } else {
                // Insertion failed
                $error = "Error: " . mysqli_error($conn);
            }
        } else {
            // Passwords don't match
            $passwordNotMatch = true;
        }
    } else {
        // Email already exists
        $EmailError = true;
    }
}


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