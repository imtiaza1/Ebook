<?php
include('partials/_header.php');
include('partials/_connection.php');

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
                    <li class="active active-menu">
                        <a href="categories.php">
                            <i class="ri-function-line"></i><span>Books Category</span>
                        </a>
                    </li>
                    <li>
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
                                <h4 class="card-title">Category Lists</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <a href="_categoriesInsert.php" class="btn btn-primary">Add New Category</a>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="data-tables table table-striped table-bordered dataTable no-footer" style="width: 100%" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th width="5%" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 21px">
                                                            No
                                                        </th>
                                                        <th width="20%" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Category Name: activate to sort column ascending" style="width: 149px">
                                                            Category Name
                                                        </th>
                                                        <th width="65%" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Category Description: activate to sort column ascending" style="width: 573px">
                                                            Category Description
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" style="width: 100px">
                                                            status
                                                        </th>
                                                        <th width="10%" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 54px">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                // fetch * categories from database;
                                                $sql = mysqli_query($con, 'SELECT * FROM categories');
                                                while ($row = mysqli_fetch_array($sql)) {
                                                    $categories_id = $row['id'];
                                                ?>
                                                    <tbody>
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1"><?php echo $row['0']; ?></td>
                                                            <td><?php echo $row['1']; ?></td>
                                                            <td>
                                                                <p class="mb-0">
                                                                    <?php echo $row['2']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($row['status'] == 1) {
                                                                ?>
                                                                    <a href="partials/_handleStatus.php?ctype=status&operation=deactive&id=<?php echo $categories_id; ?>" class="btn btn-primary active mb-3">Active</a>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <a href="partials/_handleStatus.php?ctype=status&operation=active&id=<?php echo $categories_id; ?>" class="btn btn-warning active mb-3">Deactive</a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="flex align-items-center list-user-action">
                                                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="_categoriesupdate.php?id=<?php echo $row['0']; ?>"><i class="ri-pencil-line"></i></a>
                                                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="partials/_delete.php?cid=<?php echo $row['0']; ?>"><i class="ri-delete-bin-line"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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