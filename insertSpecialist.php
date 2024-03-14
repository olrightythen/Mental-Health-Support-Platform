<?php
    $con = mysqli_connect("localhost","root","","mhsp");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());

    if (isset($_POST['insert'])) {

        $id = $_POST['id'];

        $name = $_POST['name'];

        $pro = $_POST['profession'];

        $phone = $_POST['phone'];

        $add = $_POST['address'];




            $sql = "INSERT INTO `specialist` VALUES ('$id','$name','$pro','$phone','$add')";

            $result = $con->query($sql); 

            if ($result == TRUE) {

                echo "Record added successfully.";

            }else{

                echo "Error:" . $sql . "<br>" . $con->error;

             }

    }

?>


<!-- HTML FILE -->
<html>
    <head>
        <link rel="stylesheet" href="insert.css">
        <title>Insert New Specialist</title>
    </head>
    <body>
        <h1>Please Enter the Details</h1>
        <form action="" method="post">
            <label for="id">ID : </label><input type="number" name="id">
            <label for="name">Name : </label><input type="text" name="name">
            <label for="profession">Profession : </label><input type="text" name="profession">
            <label for="phone">Phone : </label><input type="number" name="phone">
            <label for="address">Address : </label><input type="text" name="address">
            <input type="submit" name="insert" value="Add">
        </form>
    </body>
</html>
