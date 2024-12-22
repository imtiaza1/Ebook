<?php
session_start();
// Unset specific session variables related to the user profile
unset($_SESSION['email']);
header('location:../index.php');
