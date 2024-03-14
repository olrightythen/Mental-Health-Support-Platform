<?php
    $con = mysqli_connect("localhost","root","","mhsp");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());

    include 'adminnavfixed.php';
?>
<section>
<?php 
    $sql = "SELECT id,name, profession ,phone, address FROM specialist";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $sn = 0;
?>
        <h1>Specialist Details</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Profession</th>
                <th>Phone</th>
                <th>Address</th>
                <th></th>
            </tr>
<?php
        // output data of each row
        while($row = $result->fetch_assoc()) {
?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['profession']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><a class="btn update" target="_blank" href="updateSpecialist.php?id=<?php echo $row['id']; ?>">Update</a>&nbsp;<a class="btn delete" id="<?php echo $row['id']; ?>">Delete</a></td>
            </tr> 
<?php      
        }
    } else {
        echo "<h2>No Results Found!</h2>";
    }
$con->close();
        ?>
    </table>
    <a class="btn add" target="_blank" href="insertSpecialist.php">Add</a>
</section>
<script>
    var x =document.querySelectorAll(".delete");
    x.forEach(del => {
        del.addEventListener("click", ()=> {
            var li = del.getAttribute("id");
            var check = confirm("Do you want to delete this data?");
            if(check === true) {
                let file = "delete.php?id="+li+"&db=specialist";
                window.open(file);
        }
        });

    });
</script>
</body>
</html>