<?php
include '_connection.php';
// delete code for competitions
if (isset($_GET['id'])) {
    // Sanitize input to prevent SQL injection
    $competition_id = mysqli_real_escape_string($con, $_GET['id']);

    // Construct the DELETE query
    $sql = "DELETE FROM competitions WHERE competition_id='$competition_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Deletion successful
        header('location: ../competitions.php');
    } else {
        // Deletion failed
        echo "Error: " . mysqli_error($con);
    }
}


// delete code for  books
if (isset($_GET['bid'])) {
    // Sanitize input to prevent SQL injection
    $book_id = mysqli_real_escape_string($con, $_GET['bid']);

    // Construct the DELETE query
    $sql = "DELETE FROM books WHERE book_id='$book_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Deletion successful
        header('location: ../books.php');
    } else {
        // Deletion failed
        echo "Error: " . mysqli_error($con);
    }
}

// delete code for categories
if (isset($_GET['cid'])) {
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['cid']);

    // Construct the DELETE query
    $sql = "DELETE FROM categories WHERE id='$id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Deletion successful
        header('location: ../categories.php');
    } else {
        // Deletion failed
        echo "Error: " . mysqli_error($con);
    }
}

// delete code for users
if (isset($_GET['uid'])) {
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['uid']);

    // Construct the DELETE query
    $sql = "DELETE FROM users WHERE user_id='$id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Deletion successful
        header('location: ../user.php');
    } else {
        // Deletion failed
        echo "Error: " . mysqli_error($con);
    }
}

// delete code for order
if (isset($_GET['oid'])) {
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['oid']);

    // Construct the DELETE query
    $sql = "DELETE FROM orders WHERE OrderID='$id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Deletion successful
        header('location: ../order.php');
    } else {
        // Deletion failed
        echo "Error: " . mysqli_error($con);
    }
}
