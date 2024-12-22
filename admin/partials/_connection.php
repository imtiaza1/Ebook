<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'ebook';
$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    echo "error" . mysqli_connect_error($con);
    exit;
}
