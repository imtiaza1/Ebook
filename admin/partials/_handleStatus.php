<?php
include('_connection.php');
// handle status for books
if (isset($_GET['booktype']) && $_GET['booktype'] !== '') {
    $type = $_GET['booktype'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        $book_id = $_GET['id'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status = "UPDATE books SET status='$status' where book_id='$book_id'";
        $result = mysqli_query($con, $update_status);
        if ($result) {
            header('location: ../books.php');
        }
    }
}

// handle status for categories
if (isset($_GET['ctype']) && $_GET['ctype'] !== '') {
    $type = $_GET['ctype'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        $categories_id = $_GET['id'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status = "UPDATE categories SET status='$status' where id='$categories_id'";
        $result = mysqli_query($con, $update_status);
        if ($result) {
            header('location: ../categories.php');
            // Ensure no further code execution after redirection
        }
    }
}

// handle status for competitions
if (isset($_GET['competitiontype']) && $_GET['competitiontype'] !== '') {
    $type = $_GET['competitiontype'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        $competition_id = $_GET['id'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status = "UPDATE competitions SET status='$status' where competition_id='$competition_id'";
        $result = mysqli_query($con, $update_status);
        if ($result) {
            header('location: ../competitions.php');
            // Ensure no further code execution after redirection
        }
    }
}

// handle status for orders
if (isset($_GET['order_status']) && $_GET['order_status'] !== '') {
    $type = $_GET['order_status'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        $order_id = $_GET['id'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status = "UPDATE orders SET Status='$status' where OrderID='$order_id'";
        $result = mysqli_query($con, $update_status);
        if ($result) {
            header('location: ../order.php');
            // Ensure no further code execution after redirection
        }
    }
}
