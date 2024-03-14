<?php
    $con = mysqli_connect("localhost","root","","mhsp");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="client.css">
    <title>Resources</title>
</head>
<body>
    <div class="container">
        <h1>Available Resources</h1>
        <table>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
            <?php 
                $sql = "SELECT title, description ,link FROM resources";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    $sn = 0;
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    
                    echo "<tr>";
                    echo "<td>".++$sn."</td>";
                    echo "<td><a href='".$row["link"]."' target='_'>".$row["title"]."</a></td>";
                    echo "<td>".$row["description"]."</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "0 results";
                }
                $con->close();
            ?>
        </table>
    </div>
</body>
</html>
