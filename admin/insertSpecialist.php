<?php
$con = mysqli_connect("localhost", "root", "", "mhsp");

if (!$con)
    die("Connection Failed" . mysqli_connect_error());

$idErr = "";

include '../components/adminnavfixed.php';

if (isset($_POST['insert'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pro = $_POST['profession'];
    $phone = $_POST['phone'];
    $add = $_POST['address'];

    //Check if the id is already exists in database
    $checkId = "SELECT * FROM specialist WHERE id = ?";
    $checkIdStmt = $con->prepare($checkId);
    $checkIdStmt->bind_param("s", $id);
    $checkIdStmt->execute();
    $checkIdResult = $checkIdStmt->get_result();
    if ($checkIdResult->num_rows > 0) {
        $idErr = "ID already exist";
    }
    $checkIdStmt->close();

    if (empty($idErr)) {
        $sql = "INSERT INTO `specialist` VALUES ('$id','$name','$pro','$phone','$add')";
        $result = $con->query($sql);
        if ($result == TRUE) {
            header("Location: managespecialist.php?status=inserted");
            exit;
        } else {
            echo "<script>alert('Something went wrong!')</script>";
        }
    }
}
?>
<section class="update">
    <button class="back-button" onclick="history.back()">&lt; Go Back </button>
    <h1>Please Enter the Specialist Details</h1>
    <form action="" method="post" onsubmit="return validateForm()" name="insertForm">
        <label for="id">ID : </label><input type="number" name="id" id="id">
        <span class="error" id="idErr"><?php echo $idErr; ?></span><br>
        <label for="name">Name : </label><input type="text" name="name" id="name">
        <span class="error" id="nameErr"></span> <br>
        <label for="profession">Profession : </label><input type="text" name="profession" id="profession">
        <span class="error" id="professionErr"></span> <br>
        <label for="phone">Phone : </label><input type="number" name="phone" id="phone">
        <span class="error" id="phoneErr"></span> <br>
        <label for="address">Address : </label><input type="text" name="address" id="address">
        <span class="error" id="addressErr"></span> <br>
        <input type="submit" name="insert" value="Add">
    </form>
</section>
<script>
    function validateForm() {
        let id = document.getElementById("id").value;
        let name = document.getElementById("name").value;
        let profession = document.getElementById("profession").value;
        let phone = document.getElementById("phone").value;
        let address = document.getElementById("address").value;

        document.getElementById("idErr").innerHTML = "";
        document.getElementById("nameErr").innerHTML = "";
        document.getElementById("professionErr").innerHTML = "";
        document.getElementById("phoneErr").innerHTML = "";
        document.getElementById("addressErr").innerHTML = "";

        let errors = [];

        if (id == "") {
            errors.push({
                id: "idErr",
                msg: "ID is required"
            });
        } else {
            if (id < 0) {
                errors.push({
                    id: "idErr",
                    msg: "ID cannot be negative"
                });
            }
        }

        if (name == "") {
            errors.push({
                id: "nameErr",
                msg: "Name cannot be empty"
            });
        } else {
            let nameFormat = /^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/;
            if (!(name.match(nameFormat))) {
                errors.push({
                    id: "nameErr",
                    msg: "Enter a valid name"
                });
            }
        }

        if (profession == "") {
            errors.push({
                id: "professionErr",
                msg: "Profession cannot be empty"
            });
        } else {
            let professionFormat = /^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/;
            if (!(profession.match(professionFormat))) {
                errors.push({
                    id: "professionErr",
                    msg: "Enter a valid profession"
                });
            }
        }

        if (phone == "") {
            errors.push({
                id: "phoneErr",
                msg: "Phone cannot be empty"
            });
        } else {
            let phoneFormat = /(\+977)?[9][6-9]\d{8}/gm;
            if (!(phone.match(phoneFormat))) {
                errors.push({
                    id: "phoneErr",
                    msg: "Enter a valid phone number"
                });
            }
        }

        if (address == "") {
            errors.push({
                id: "addressErr",
                msg: "Address cannot be empty"
            });
        } else {
            let addressFormat = /^[a-zA-Z0-9\s,.'-]{3,}$/;
            if (!(address.match(addressFormat))) {
                errors.push({
                    id: "addressErr",
                    msg: "Enter a valid address"
                });
            } else {
                if (address.length < 8) {
                    errors.push({
                        id: "addressErr",
                        msg: "Address must be atleast 8 characters long"
                    });
                }
            }
        }

        if (errors.length > 0) {
            errors.forEach((error) => {
                document.getElementById(error.id).innerHTML = error.msg;
            });
            return false;
        }

        return true;
    }
</script>
</body>

</html>