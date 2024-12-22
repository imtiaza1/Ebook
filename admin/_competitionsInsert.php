<?php
include('partials/_header.php');
include('partials/_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $competition_id = mysqli_real_escape_string($con, $_POST['competition_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $prize_details = mysqli_real_escape_string($con, $_POST['prize_details']);

    // Prepare the SQL statement to update competition details
    $sql = "INSERT INTO `competitions` ( `title`, `description`, `start_date`, `end_date`, `prize_details`, `status`) VALUES ( '$title', '$description', '$start_date', '$end_date', '$prize_details', '0');";

    $result = mysqli_query($con, $sql);

    // Execute the query
    if ($result) {
        // Update successful
        header('location: competitions.php');
    } else {
        // Update failed
        echo "Error: Unable to update competition.";
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
                    <li class="">
                        <a href="books.php"><i class="ri-file-pdf-line"></i><span>Books</span></a>
                    </li>
                    <li class="">
                        <a href="user.php"><i class="las la-th-list"></i><span>Users</span></a>
                    </li>
                    <li class="active active-menu">
                        <a href="Competitions.php"><i class="fa-solid fa-trophy"></i><span>Competitions</span></a>
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
                                <h4 class="card-title">Add competitions</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="competition_id" value="">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" class="form-control" name="title" value="">
                                </div>
                                <div class=" form-group">
                                    <label>Description:</label>
                                    <textarea class="form-control" rows="4" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>start_date:</label>
                                    <input type="date" class="form-control" name="start_date" value="">
                                </div>
                                <div class="form-group">
                                    <label>end_date:</label>
                                    <input type="date" class="form-control" name="end_date" value="">
                                </div>
                                <div class="form-group">
                                    <label>prize_details:</label>
                                    <input type="text" class="form-control" name="prize_details" value="">
                                </div>
                                <button type="submit" class="btn btn-primary">submit</button>
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