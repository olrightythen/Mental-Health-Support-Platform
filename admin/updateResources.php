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
    <button class="back-button" onclick="history.back()">&lt; Go Back </button>
    <h1>Please Update the Details</h1>
    <form action="" method="post" onsubmit="return validateForm()">
        <label for="id">ID : </label><input type="number" name="id" id="id" value="<?php echo $id; ?>" readonly>
        <span class="error" id="idErr"></span><br>
        <label for="title">Title : </label><input type="text" name="title" id="title" value="<?php echo $title; ?>">
        <span class="error" id="titleErr"></span> <br>
        <label for="category">Category : </label><input type="text" name="category" id="category" value="<?php echo $cat; ?>">
        <span class="error" id="categoryErr"></span> <br>
        <label for="description">Description : </label><input type="text" name="description" id="description" value="<?php echo $des; ?>">
        <span class="error" id="descriptionErr"></span> <br>
        <label for="link">Link : </label><input type="text" name="link" id="link" value="<?php echo $link; ?>">
        <span class="error" id="linkErr"></span><br>
        <input type="submit" name="update" value="Update">
    </form>
</section>
<script>
    function validateForm() {
        let title = document.getElementById("title").value;
        let category = document.getElementById("category").value;
        let description = document.getElementById("description").value;
        let link = document.getElementById("link").value;

        document.getElementById("titleErr").innerHTML = "";
        document.getElementById("categoryErr").innerHTML = "";
        document.getElementById("descriptionErr").innerHTML = "";
        document.getElementById("linkErr").innerHTML = "";

        let errors = [];

        if (title === "") {
            errors.push({
                id: "titleErr",
                msg: "Title is required"
            });
        } else {
            let titleFormat = /^[a-zA-Z\s]+$/;
            if (!title.match(titleFormat)) {
                errors.push({
                    id: "titleErr",
                    msg: "Title must contain only letters and spaces"
                });
            }
        }

        if (category === "") {
            errors.push({
                id: "categoryErr",
                msg: "Category is required"
            });
        } else {
            let categoryFormat = /^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/;
            if (!category.match(categoryFormat)) {
                errors.push({
                    id: "categoryErr",
                    msg: "Category must contain only letters and spaces"
                });
            }
        }

        if (description === "") {
            errors.push({
                id: "descriptionErr",
                msg: "Description is required"
            });
        } else {
            let descriptionFormat = /^[a-zA-Z\s]+$/;
            if (!description.match(descriptionFormat)) {
                errors.push({
                    id: "descriptionErr",
                    msg: "Description must contain only letters and spaces"
                });
            } else if (description.length < 10) {
                errors.push({
                    id: "descriptionErr",
                    msg: "Description must be at least 10 characters long"
                });
            }
        }

        if (link == "") {
            errors.push({
                id: "linkErr",
                msg: "Link is required"
            });
        } else {
            let linkFormat = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/gi;
            if (!(link.match(linkFormat))) {
                errors.push({
                    id: "linkErr",
                    msg: "Enter a valid link"
                });
            }
        }

        if (errors.length > 0) {
            errors.forEach(function(err) {
                document.getElementById(err.id).innerHTML = err.msg;
            });
            return false;
        }

        return true;
    }
</script>
</body>

</html>