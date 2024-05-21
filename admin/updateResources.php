<?php
// Connect to database
$con = mysqli_connect("localhost", "root", "", "mhsp");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Include necessary files
include '../components/adminnavfixed.php';

// Function to handle SQL injection
function clean_input($data)
{
    global $con;
    return mysqli_real_escape_string($con, $data);
}

// Handle update request
if (isset($_POST['update'])) {
    $id = clean_input($_POST['id']);
    $title = clean_input($_POST['title']);
    $des = clean_input($_POST['description']);
    $link = clean_input($_POST['link']);
    $cat = clean_input($_POST['category']);

    // Prepare and execute statement
    $stmt = $con->prepare("UPDATE `resources` SET `title`=?, `category`=?, `description`=?, `link`=? WHERE `id`=?");
    $stmt->bind_param("ssssi", $title, $cat, $des, $link, $id);

    if ($stmt->execute()) {
        header("Location: manageresources.php?status=updated");
        exit;
    } else {
        echo "Error: " . $con->error;
    }
}

// Handle GET request for editing
if (isset($_GET['id'])) {
    $id = clean_input($_GET['id']);

    // Fetch record to be updated
    $sql = "SELECT * FROM `resources` WHERE `id`='$id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $des = $row['description'];
            $link = $row['link'];
            $cat = $row['category'];
        }
    } else {
        echo "<h2>No Results Found!</h2>";
    }
}

// Close connection
mysqli_close($con);
?>

<section class="update">
    <div class="container">
        <button class="back-button" onclick="history.back()">&lt; Go Back</button>
        <h1>Please Update the Details</h1>
        <form action="" method="post">
            <label for="id">ID :</label><input type="number" name="id" value="<?php echo $id ?>" readonly>
            <span class="error"></span>
            <label for="title">Title :</label><input type="text" name="title" value="<?php echo $title ?>">
            <span class="error"></span>
            <label for="category">Category :</label><input type="text" name="category" value="<?php echo $cat ?>">
            <span class="error"></span>
            <label for="description">Description :</label><textarea id="description" name="description" rows="4"><?php echo $des ?></textarea>
            <span class="error"></span>
            <label for="link">Link :</label><input type="text" name="link" value="<?php echo $link ?>">
            <span class="error"></span>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</section>
</body>

</html>