<?php
    $con = mysqli_connect("localhost","root","","mhsp");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());

    if (isset($_POST['update'])) {

        $id = $_POST['id'];

        $title = $_POST['title'];

        $des = $_POST['description'];

        $link = $_POST['link'];

        $sql = "UPDATE `resources` SET `title`='$title',`description`='$des',`link`='$link' WHERE `id`='$id'"; 

        $result = $con->query($sql); 

        if ($result == TRUE) {

            echo "Record updated successfully.";

        }else{

            echo "Error:" . $sql . "<br>" . $con->error;

        }

    }


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM `resources` WHERE `id`='$id'";

    $result = $con->query($sql); 

    if ($result->num_rows > 0) {        

        while ($row = $result->fetch_assoc()) {
            
            $title = $row['title'];
            
            $des = $row['description'];
            
            $link = $row['link'];

        }
?>


<!-- HTML FILE -->
<html>
    <head>
        <link rel="stylesheet" href="update.css">
        <title>Update Resources</title>
    </head>
    <body>
        <h1>Please Update the Details</h1>
        <form action="" method="post">
            <label for="id">ID : </label><input type="number" name="id" value="<?php echo $id?>" readonly>
            <label for="title">Title : </label><input type="text" name="title" value="<?php echo $title?>">
            <label for="description">Description : </label><input type="text" name="description" value="<?php echo $des?>">
            <label for="link">Link : </label><input type="text" name="link" value="<?php echo $link?>">
            <input type="submit" name="update" value="Update">
        </form>
    </body>
</html>


<?php

    } else{ 

        header('Location: index.php');

    } 

}
?> 