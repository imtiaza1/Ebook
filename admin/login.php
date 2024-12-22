<?php
session_start();
include('partials/_connection.php');
$error = true;
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    //verify username and password
    $check = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $sql = mysqli_query($con, $check);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        $_SESSION['username'] = $username;
        // User found, redirect to admin dashboard
        header('Location: index.php');

        exit(); // stop further execution
    } else {
        $error = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>eBook-login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <section class="sign-in-page">
        <div class="container p-0">
            <div class="row no-gutters height-self-center">
                <div class="col-sm-12 align-self-center page-content rounded">
                    <div class="row m-0">
                        <div class="col-sm-12 sign-in-page-data">
                            <div class="sign-in-from bg-primary rounded">
                                <h3 class="mb-0 text-center text-white">Sign in</h3>
                                <p class="text-center text-white">
                                    Enter your username and password to access admin panel.
                                </p>
                                <form class="mt-4 form-text" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control mb-0" name="username" placeholder="Enter username" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password" />
                                    </div>
                                    <div class="sign-info text-center">
                                        <button type="submit" name="submit" class="btn btn-white d-block w-100 mb-2">
                                            Sign in
                                        </button>
                                        <span class="text-dark dark-color d-inline-block line-height-2">
                                            <?php if (!$error) {
                                                echo '<i class="fa-solid fa-circle-exclamation"></i>  ';
                                                echo "username or password is not valid";
                                            }  ?>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>