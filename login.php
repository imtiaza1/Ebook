<?php
require('includes/header.php');
require('includes/db.php');
$error = false;
$password_matched = false;
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Check if the email exists in the database
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result_email = mysqli_query($conn, $check_email);
    $result = mysqli_num_rows($result_email);
    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($result_email)) {
            // Verify hashed password
            $checkPass = password_verify($password, $row['password']);
            // $checkPass = $password == $row['password'];
            if ($checkPass) {
                // Password matches, set session and success flag
                $_SESSION['email'] = $row['email'];
                $success = true;
                // JavaScript for redirection with delay
                echo '<script>
                    window.location.href = "index.php";
                </script>';
                exit(); // stop further execution
            } else {
                // Password does not match, set error flag
                $password_matched = true;
                break;
            }
        }
    } else {
        // Email not found in the database, set error flag
        $error = true;
    }
}
?>
<div class="page-content">
    <!-- inner page banner -->
    <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm" style="background-image:url(images/background/bg3.jpg);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Login</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"> Home</a></li>
                        <li class="breadcrumb-item">Login</li>
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
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="login-area">
                        <div class="tab-content">
                            <h4>NEW CUSTOMER</h4>
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <a class="btn btn-primary btnhover m-r5 button-lg radius-no" href="registration.php">CREATE AN ACCOUNT</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="login-area">
                        <div class="tab-content nav">
                            <form method="post" class="tab-pane active col-12">
                                <h4 class="text-secondary">LOGIN</h4>
                                <p class="font-weight-600">If you have an account with us, please log in.</p>
                                <div class="mb-4">
                                    <label class="label-title">E-MAIL *</label>
                                    <input name="email" required="" class="form-control" placeholder="Your Email Id" type="email">
                                </div>
                                <div class="mb-4">
                                    <label class="label-title">PASSWORD *</label>
                                    <input name="password" required="" class="form-control " placeholder="Type Password" type="password">
                                </div>
                                <div class="text-left">
                                    <input type="submit" name="submit" class="btn btn-primary btnhover me-2" value="login">
                                </div>
                            </form>
                        </div>
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
<?php if ($password_matched) { ?>
    <script>
        Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "The password you entered is incorrect. Please try again.",
        });
    </script>
<?php } ?>
<?php if ($error) { ?>
    <script>
        Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "The email you entered is incorrect. Please try again.",
        });
    </script>
<?php } ?>