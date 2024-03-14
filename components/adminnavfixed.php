<?php
session_start();
// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])||$_SESSION["role"] != 0) {
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
    <link rel="stylesheet" href="css/admin.css">
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
        <a href="admindashboard.php" >Dashboard</a>
        <a href="manageresources.php" >Manage Resources</a>
        <a href="managespecialist.php" >Manage Specialist Details</a>
        <a href="managecommunity.php" >Manage Community</a>
    </nav>