<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 1) {
    // User is logged in, redirect to the welcome page
    header("Location: dashboard.php");
    exit;
}

// Create connection
$con = new mysqli("localhost", "root", "", "mhsp");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$regName = $regEmail = $regPassword = $confirmPassword = "";

$regEmailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

    $regName = test_input($_POST["regName"]);

    $regEmail = test_input($_POST["regEmail"]);
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $checkEmailStmt = $con->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $regEmail);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();
    if ($checkEmailResult->num_rows > 0) {
        $regEmailErr = "Email is already taken";
    }
    // Close the statement
    $checkEmailStmt->close();

    $regPassword = test_input($_POST["regPassword"]);

    if (empty($regEmailErr)) {
        $stmt = $con->prepare("INSERT INTO users (name,email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $regName, $regEmail, $regPassword);
        $stmt->execute();
        $stmt->close();
        header("Location: login.php");
        exit();
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
        <div id="registeration-form" class="form-container">
            <h2>User Registration</h2>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
                <!-- Registration form fields go here -->
                <label for="regName">Name:</label>
                <input type="text" name="regName" id="regName" value="<?php echo $regName; ?>">
                <span class="error" id="regNameErr"></span>
                <br><br>

                <label for="regEmail">Email:</label>
                <input type="text" name="regEmail" id="regEmail" value="<?php echo $regEmail; ?>">
                <span class="error" id="regEmailErr"><?php echo $regEmailErr; ?></span>
                <br><br>


                <label for="regPassword">Password:</label>
                <input type="password" name="regPassword" id="regPassword" value="<?php echo $regPassword; ?>">
                <span class="error" id="regPasswordErr"></span>
                <br><br>

                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" value="<?php echo $regPassword; ?>">
                <span class="error" id="confirmPasswordErr"></span>
                <br><br>

                <input class="submit-button" type="submit" name="register" value="Register">
                <br>

                <p>Already have an account? <a class="toggle-button" href="login.php">Click here</a> to log in.</p>

            </form>
        </div>
    </main>
    <script>
        function validateForm() {
            var regName = document.getElementById("regName").value;
            var regEmail = document.getElementById("regEmail").value;
            var regPassword = document.getElementById("regPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            var errors = [];

            // Reset previous error messages
            document.getElementById("regNameErr").innerText = "";
            document.getElementById("regEmailErr").innerText = "";
            document.getElementById("regPasswordErr").innerText = "";

            // Validate Name
            if (regName === "") {
                errors.push({
                    id: "regNameErr",
                    msg: "Name is required"
                });
            } else {
                var nameFormat = /^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/;
                if (!(regName.match(nameFormat))) {
                    errors.push({
                        id: "regNameErr",
                        msg: "Enter a valid name"
                    });
                }
            }

            // Validate Email
            if (regEmail === "") {
                errors.push({
                    id: "regEmailErr",
                    msg: "Email is required"
                });
            } else {
                var mailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
                if (!(regEmail.match(mailFormat))) {
                    errors.push({
                        id: "regEmailErr",
                        msg: "Enter a valid email"
                    });
                }
            }

            // Validate Password
            if (regPassword === "") {
                errors.push({
                    id: "regPasswordErr",
                    msg: "Password is required"
                });
            } else {
                if (regPassword.length < 8) {
                    errors.push({
                        id: "regPasswordErr",
                        msg: "Password must be at least 8 characters long"
                    });
                } else {
                    var passStrength = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
                    if (!(regPassword.match(passStrength))) {
                        errors.push({
                            id: "regPasswordErr",
                            msg: "Password must include at least one uppercase letter, one lowercase letter, one digit and one special character."
                        });
                    }
                }
            }

            // Validate Confirm Password
            if (confirmPassword === "") {
                errors.push({
                    id: "confirmPasswordErr",
                    msg: "Please confirm the password"
                });
            } else {
                if (regPassword !== confirmPassword) {
                    errors.push({
                        id: "confirmPasswordErr",
                        msg: "Passwords do not match"
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