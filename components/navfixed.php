<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"]) || $_SESSION["role"] != 1) {
    header("Location: index.php");
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/user.css">
    <title>Mental Health Support Platform</title>
    <script>
        function toggleNav() {
            let nav = document.getElementById("nav");
            if (nav.style.display === "block") {
                nav.style.display = "none";
            } else {
                nav.style.display = "block";
            }
        }
    </script>
</head>

<body>
    <header>
        <div class="header-buttons">
            <div class="hamburger" onclick="toggleNav()">&#9776;</div>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <h1>Mental Health Support Platform</h1>
    </header>

    <nav id="nav">
        <a href="dashboard.php" <?php activePage('dashboard.php'); ?>>Dashboard</a>
        <a href="resources.php" <?php activePage('resources.php'); ?>>Resources</a>
        <a href="specialist.php" <?php activePage('specialist.php'); ?>>Specialists</a>
        <a href="community.php" <?php activePage('community.php'); ?>>Community</a>
    </nav>