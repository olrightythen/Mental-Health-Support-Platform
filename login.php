<?php
session_start();
// Create connection
$con = mysqli_connect("localhost", "root", "", "mhsp");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define variables to store user input for login
$logEmail = $logPassword = "";

// Define variables to store error messages for login
$logPasswordErr = "";

// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    $logEmail = test_input($_POST["logEmail"]);

    $logPassword = test_input($_POST["logPassword"]);

    // Retrieve password from the database based on the entered Email
    $sqlPassword = "SELECT * FROM users WHERE email = '$logEmail'";
    $result = mysqli_query($con, $sqlPassword);
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];
    $name = $row['name'];

    // Verify the entered password against the hashed password
    if ($logPassword===$password) {
        // Password is correct, redirect to the home page or perform other actions
        $_SESSION["username"] = $name;
        header("Location: index.php");
        exit();
    } else {
        // Password is incorrect
        $logPasswordErr = "Incorrect password";
    }
}

// Function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close the database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/form.css">
    <script>
        function validateForm() {
            var logEmail = document.getElementById("logEmail").value;
            var logPassword = document.getElementById("logPassword").value;

            // Reset previous error messages
            document.getElementById("logEmailErr").innerText = "";
            document.getElementById("logEmailErr").innerText = "";

            // Validate Email
            if (logEmail === "") {
                document.getElementById("logEmailErr").innerText = "Email is required";
                return false;
            }

            // Validate Password
            if (logPassword === "") {
                document.getElementById("logPasswordErr").innerText = "Password is required";
                return false;
            }

            // Display server-side email error if it exists
            var passwordError = "<?php echo $logPasswordErr; ?>";
            if (passwordError !== "") {
                document.getElementById("logPasswordErr").innerText = passwordError;
                return false;
            }

            return true;
        }
    </script> 
</head>
<body>
<div id="login-form" class="container">
    <h2>User Login</h2>
        <form method="post" action="login.php" onsubmit="return validateForm()">
            <!-- Login form fields go here -->
            <label for="logEmail">Email:</label>
            <input type="text" name="logEmail" id="logEmail" value="<?php echo $logEmail; ?>">
            <span class="error" id="logEmailErr"></span>
            <br><br>

            <label for="logPassword">Password:</label>
            <input type="password" name="logPassword" id="logPassword">
            <span class="error" id="logPasswordErr"></span>
            <br><br>

            <input class="submit-button" type="submit" name="login" value="Login">
            <br>

            <p>Don't have an account? <a class="toggle-button" href="register.php">Click here</a> to register.</p>

        </form>
</div>
</body>
</html>