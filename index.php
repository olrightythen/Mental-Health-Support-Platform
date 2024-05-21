<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 1) {
    // User is logged in, redirect to the welcome page
    header("Location: dashboard.php");
    exit;
} else if (isset($_SESSION['role']) && $_SESSION['role'] === 0) {
    // Admin is logged in, redirect to the welcome page
    header("Location: admin/admindashboard.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Support Platform</title>
    <link rel="shortcut icon" href="./images/favion.png" type="image/x-icon">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <header class="header">
        <div class="logo-container">
            <div class="logo">
                Mental Health Support Platform
            </div>
        </div>
        <div class="auth-buttons">
            <button class="login-btn"><a href="./login.php">Login</a></button>
            <button class="signup-btn"><a href="./register.php">Signup</a></button>
        </div>
    </header>
    <main class="main-content">
        <div class="text-content">
            <h1>We Will Help <br>
                You To Improve <br>
                Your Mental Health
            </h1>
            <p>Connect with licensed specialists and find the support you need, anytime, anywhere.</p>
            <div class="buttons">
                <a href="./login.php"><button class="appointment-btn">Get Resources</button></a>
                <a href="./login.php"><button class="specialist-btn">Find Specialist</button></a>
            </div>
        </div>
        <div class="image-content">
            <img src="images/bg.png" alt="Healthcare Professional">
        </div>
    </main>
    </div>
</body>

</html>