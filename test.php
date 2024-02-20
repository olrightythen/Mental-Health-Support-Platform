<?php
session_start();
// Create connection
$con = mysqli_connect("localhost", "root", "", "mhsp");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
        $logPassword="dministrator";
        $sqlPassword = "SELECT password FROM users WHERE email = 'admin@gmail.com'";
        $result = mysqli_query($con, $sqlPassword);
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];

        if ($logPassword===$password) {
                echo $password;
        } else {
                echo "Error";
        }
        mysqli_close($con);
?>
