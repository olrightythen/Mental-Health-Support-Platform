<?php
session_start();
// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

$username = $_SESSION["username"];
// If the user is logged in, you can display the home page content
include 'adminnavfixed.php';
?>
