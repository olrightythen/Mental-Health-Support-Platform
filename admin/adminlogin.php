<?php
// Create connection
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 0) {
    // User is logged in, redirect to the welcome page
    header("Location: admindashboard.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "mhsp");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define variables to store user input for login
$logUsername = $logPassword = "";

// Define variables to store error messages for login
$logPasswordErr = "";

// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    $logUsername = test_input($_POST["logUsername"]);

    $logPassword = test_input($_POST["logPassword"]);

    // Retrieve password from the database based on the entered Username
    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $logUsername);
    $stmt->execute();
    $stmt->bind_result($Password);
    $stmt->fetch();
    if ($stmt->num_rows > 0) {
        $logPasswordErr = "Wrong Username or password";
    }
    $stmt->close();

    // Retrieve name from the database based on the entered username
    $stmt = $conn->prepare("SELECT name FROM admins WHERE username = ?");
    $stmt->bind_param("s", $logUsername);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
    // Verify the entered password against the  password
    if ($logPassword === $Password) {
        // Password is correct, redirect to the home page or perform other actions
        $_SESSION["username"] = $name;
        $_SESSION["role"] = 0;
        header("Location: admindashboard.php");
        exit();
    } else {
        // Password is incorrect
        $logPasswordErr = "Incorrect password";
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
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" href="./images/favion.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/form.css">
</head>

<body>
    <header class="admin-header">
        <div class="logo-container">
            <div class="logo">
                Mental Health Support Platform
            </div>
        </div>
    </header>
    <main>
        <div id="login-form" class="form-container">
            <h2>Admin Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
                <!-- Login form fields go here -->
                <label for="logUsername">Username:</label>
                <input type="text" name="logUsername" id="logUsername" value="<?php echo $logUsername; ?>">
                <span class="error" id="logUsernameErr"></span>
                <br><br>

                <label for="logPassword">Password:</label>
                <input type="password" name="logPassword" id="logPassword" value="<?php echo $logPassword; ?>">
                <span class="error" id="logPasswordErr"><?php echo $logPasswordErr; ?></span>
                <br><br>

                <input class="submit-button" type="submit" name="login" value="Login">
                <br>

            </form>
        </div>
    </main>
    <script>
        function validateForm() {
            var logUsername = document.getElementById("logUsername").value;
            var logPassword = document.getElementById("logPassword").value;

            // Reset previous error messages
            document.getElementById("logUsernameErr").innerText = "";
            document.getElementById("logUsernameErr").innerText = "";

            // Validate Username
            if (logUsername === "") {
                document.getElementById("logUsernameErr").innerText = "Username is required";
                return false;
            }

            // Validate Password
            if (logPassword === "") {
                document.getElementById("logPasswordErr").innerText = "Password is required";
                return false;
            }

            return true;
        }
    </script>
</body>

</html>