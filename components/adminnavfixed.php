<?php
session_start();
// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"]) || $_SESSION["role"] != 0) {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION["username"];

function activePage($page)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage == $page) {
        echo 'class="active"';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Mental Health Support Platform</title>
</head>

<body>
    <header>
        <div class="logout">
            <a href="../logout.php">Logout</a>
        </div>
        <h1>Mental Health Support Platform</h1>
    </header>

    <nav>
        <a href="admindashboard.php" <?php activePage('admindashboard.php'); ?>>Dashboard</a>
        <a href="manageresources.php" <?php activePage('manageresources.php'); ?>>Manage Resources</a>
        <a href="managespecialist.php" <?php activePage('managespecialist.php'); ?>>Manage Specialists</a>
        <a href="manageposts.php" <?php activePage('manageposts.php'); ?>>Manage Posts</a>
        <a href="manageusers.php" <?php activePage('manageusers.php'); ?>>Manage Users</a>
    </nav>