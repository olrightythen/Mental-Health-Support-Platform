<?php
// Include the file for database configuration if necessary
// include 'db_config.php';

// Function to get the number of rows in a table
function getRowCount($con, $table)
{
    $sql = "SELECT COUNT(*) AS count FROM $table";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $stmt->close();
    return $count;
}

// Establish database connection
$con = new mysqli("localhost", "root", "", "mhsp");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Include the navigation component
include '../components/adminnavfixed.php';

?>

<section class="dashboard">
    <h1>Welcome Back, <?php echo $_SESSION["username"] ?>!</h1>
    <div class="container">
        <a href="manageusers.php" class="dash-box">
            <h3>Number of Registered Users : <?php echo getRowCount($con, "users"); ?></h3>
            <img src="../images/users.png" alt="users">
        </a>
        <a href="manageresources.php" class="dash-box">
            <h3>Number of Resources : <?php echo getRowCount($con, "resources"); ?></h3>
            <img src="../images/resources.png" alt="resources">
        </a>
        <a href="managespecialist.php" class="dash-box">
            <h3>Number of Specialists : <?php echo getRowCount($con, "specialist"); ?></h3>
            <img src="../images/specialist.png" alt="specialist">
        </a>
    </div>
</section>
</body>

</html>

<?php
// Close the database connection
$con->close();
?>