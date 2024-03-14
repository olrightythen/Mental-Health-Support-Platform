<?php 
    $con = mysqli_connect("localhost","root","","mhsp");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];
    $db = $_GET['db'];

    $sql = "DELETE FROM `$db` WHERE `id`='$user_id'";

     $result = $con->query($sql);

     if ($result == TRUE) {

        header("Location: $db.php");

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}


?>