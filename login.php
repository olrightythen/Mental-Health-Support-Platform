<?php
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

    // Retrieve hashed password from the database based on the entered Email
    $stmt = $con->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $logEmail);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();
    if ($stmt->num_rows > 0) {
        $logPasswordErr = "Wrong email or password";
    }
    $stmt->close();

    // Retrieve name from the database based on the entered Email
    $stmt = $con->prepare("SELECT name FROM users WHERE email = ?");
    $stmt->bind_param("s", $logEmail);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
    // Verify the entered password against the password from database
    if ($logPassword == $password) {
        // Password is correct, redirect to the home page or perform other actions
        session_start();
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
            var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!(logEmail.match(mailFormat)))
            {
                document.getElementById("logEmailErr").innerText = "Please enter a valid email";
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
            <input type="password" name="logPassword" id="logPassword" value="<?php echo $logPassword; ?>">
            <span class="error" id="logPasswordErr"><?php echo $logPasswordErr; ?></span>
            <br><br>

            <input class="submit-button" type="submit" name="login" value="Login">
            <br>

            <p>Don't have an account? <a class="toggle-button" href="register.php">Click here</a> to register.</p>

        </form>
</div>
</body>
</html>