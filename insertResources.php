<?php
    $con = mysqli_connect("localhost","root","","mhsp");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());

    if (isset($_POST['insert'])) {

        $id = $_POST['id'];

        $title = $_POST['title'];

        $des = $_POST['description'];

        $link = $_POST['link'];

            $sql = "INSERT INTO `resources` VALUES ('$id','$title','$des','$link')";

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
        <title>Insert Resources</title>
    </head>
    <body>
        <h1>Please Enter the Details</h1>
        <form action="" method="post">
            <label for="id">ID : </label><input type="number" name="id">
            <label for="title">Title : </label><input type="text" name="title">
            <label for="description">Description : </label><input type="text" name="description">
            <label for="link">Link : </label><input type="text" name="link">
            <input type="submit" name="insert" value="Add">
        </form>
    </body>
</html>
