<?php
$con = mysqli_connect("localhost", "root", "", "mhsp");

if (!$con)
    die("Connection Failed" . mysqli_connect_error());

include '../components/adminnavfixed.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pro = $_POST['profession'];
    $phone = $_POST['phone'];
    $add = $_POST['address'];
    $sql = "UPDATE `specialist` SET `name`='$name',`profession`='$pro',`phone`='$phone',`address`='$add' WHERE `id`='$id'";
    $result = $con->query($sql);

    if ($result == TRUE) {
        header("Location: managespecialist.php?status=updated");
        exit;
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `specialist` WHERE `id`='$id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $pro = $row['profession'];
            $phone = $row['phone'];
            $add = $row['address'];
        }
?>

        <section class="update">
            <button class="back-button" onclick="history.back()">&lt; Go Back </button>
            <h1>Please Update the Details</h1>
            <form action="" method="post" onsubmit="return validateForm()">
                <label for="id">ID : </label><input type="number" name="id" id="id" value="<?php echo $id; ?>" readonly>
                <span class="error" id="idErr"></span><br>
                <label for="name">Name : </label><input type="text" name="name" id="name" value="<?php echo $name; ?>">
                <span class="error" id="nameErr"></span> <br>
                <label for="profession">Profession : </label><input type="text" name="profession" id="profession" value="<?php echo $pro; ?>">
                <span class="error" id="professionErr"></span> <br>
                <label for="phone">Phone : </label><input type="number" name="phone" id="phone" value="<?php echo $phone; ?>">
                <span class="error" id="phoneErr"></span> <br>
                <label for="address">Address : </label><input type="text" name="address" id="address" value="<?php echo $add; ?>">
                <span class="error" id="addressErr"></span> <br>
                <input type="submit" name="update" value="Update">
            </form>
        </section>
        <script>
            function validateForm() {
                let name = document.getElementById("name").value;
                let profession = document.getElementById("profession").value;
                let phone = document.getElementById("phone").value;
                let address = document.getElementById("address").value;

                document.getElementById("nameErr").innerHTML = "";
                document.getElementById("professionErr").innerHTML = "";
                document.getElementById("phoneErr").innerHTML = "";
                document.getElementById("addressErr").innerHTML = "";

                let errors = [];

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
<?php
    } else {
        header('Location: admin.php');
    }
}
?>