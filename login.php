<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 1) {
    // User is logged in, redirect to the welcome page
    header("Location: dashboard.php");
    exit;
}

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
    $stmt = $con->prepare("SELECT name,password FROM users WHERE email = ?");
    $stmt->bind_param("s", $logEmail);
    $stmt->execute();
    $stmt->bind_result($name, $password);
    $stmt->fetch();
    $stmt->close();

    // Verify the entered password against the password from database
    if (password_verify($logPassword, $password)) {
        // Password is correct, redirect to the home page or perform other actions
        session_start();
        $_SESSION["username"] = $name;
        $_SESSION["role"] = 1;
        header("Location: dashboard.php");
        exit();
    } else {
        // Password is incorrect
        $logPasswordErr = "Wrong email or password";
    }
}

// Function to sanitize user input
function test_input($data)
{
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
    <link rel="shortcut icon" href="./images/favion.png" type="image/x-icon">
    <link rel="stylesheet" href="css/form.css">
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
    <main>
        <div id="login-form" class="form-container">
            <h2>User Login</h2>
            <form method="post" action="login.php" onsubmit="return validateForm()">
                <!-- Login form fields go here -->
                <label for="logEmail">Email:</label>
                <input type="text" name="logEmail" id="logEmail" value="<?php echo $logEmail; ?>">
                <span class="error" id="logEmailErr"></span>
                <br><br>

                <label for="logPassword">Password:</label>
                <input type="password" name="logPassword" id="logPassword" value="<?php echo $logPassword; ?>">
                <span class="error" id="logPasswordErr"><?php echo $logPasswordErr; ?></span>
                <br><br>

                <input class="submit-button" type="submit" name="login" value="Login">
                <br>

                <p>Don't have an account? <a class="toggle-button" href="register.php">Click here</a> to register.</p>
            </form>
        </div>
    </main>
    <script>
        function validateForm() {
            var logEmail = document.getElementById("logEmail").value;

            var errors = [];

            // Reset previous error messages
            document.getElementById("logEmailErr").innerText = "";

            // Validate Email
            if (logEmail === "") {
                errors.push({
                    id: "logEmailErr",
                    msg: "Email is required"
                });
            } else {
                var mailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
                if (!(logEmail.match(mailFormat))) {
                    errors.push({
                        id: "logEmailErr",
                        msg: "Enter a valid email"
                    });
                }
            }

            if (errors.length !== 0) {
                for (var j = 0; j < errors.length; j++) {
                    document.getElementById(errors[j].id).innerText = errors[j].msg;
                }
                return false;
            }

            return true;
        }
    </script>
</body>

</html>