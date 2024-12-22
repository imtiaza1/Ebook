<?php
include('partials/_header.php');
include('partials/_connection.php');
// Query to select all books
$sql = "SELECT * FROM books";
// Execute the query
$result = mysqli_query($con, $sql);


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
                    <li class="active active-menu">
                        <a href="books.php"><i class="ri-file-pdf-line"></i><span>Books</span></a>
                    </li>
                    <li class="">
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
                                <h4 class="card-title">Book Lists</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <a href="_booksInsert.php" class="btn btn-primary">Add New Book</a>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>categories</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Format</th>
                                            <th>Shipping Info</th>
                                            <th>Subscription Details</th>
                                            <th>File</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row["book_id"];
                                            $title = $row["title"];
                                            $categories = $row["books_categories"];
                                            $author = $row["author"];
                                            $desc = $row["description"];
                                            $price = $row["price"];
                                            $format = $row["format"];
                                            $shipping = $row["shipping_info"];
                                            $sub = $row["subscription_details"];
                                            $image = $row["image"];
                                            $file = $row["file"];
                                            $status = $row["status"];
                                        ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><img class="img-fluid avatar-50 rounded" src="<?php echo $image; ?>" alt=""></td>
                                                <td><?php echo $title ?></td>
                                                <td><?php echo $categories ?></td>
                                                <td><?php echo $desc ?></td>
                                                <td><?php echo $price ?>$</td>
                                                <td><?php echo $format ?></td>
                                                <td><?php echo $shipping ?></td>
                                                <td><?php echo $sub ?></td>
                                                <td><a href="<?php echo $file ?>"><i class="ri-file-fill text-secondary font-size-18"></i></a></td>
                                                <td>
                                                    <?php
                                                    if ($row['status'] == 1) {
                                                    ?>
                                                        <a href="partials/_handleStatus.php?booktype=status&operation=deactive&id=<?php echo $id; ?>" class="btn btn-primary active mb-3">Active</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="partials/_handleStatus.php?booktype=status&operation=active&id=<?php echo $id; ?>" class="btn btn-warning active mb-3">Deactive</a>

                                                    <?php
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <div class="flex align-items-center list-user-action">
                                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="_booksUpdate.php?id=<?php echo $id ?>"><i class="ri-pencil-line"></i></a>
                                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Delete" href="partials/_delete.php?bid=<?php echo $id ?>"><i class="ri-delete-bin-line"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <!-- Add more rows with data as needed -->
                                    </tbody>
                                </table>


                            </div>
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