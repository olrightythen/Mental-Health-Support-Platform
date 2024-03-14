<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])||$_SESSION["role"] != 1) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/user.css">
    <title>Mental Health Support Platform</title>
</head>
<body>
    <header>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
        <h1>Mental Health Support Platform</h1>
    </header>

    <nav>
        <a href="dashboard.php" >Home</a>
        <a href="resources.php" >Resources</a>
        <a href="specialist.php" >Specialist Details</a>
        <a href="community.php" >Community</a>
    </nav>
    