<?php
$con = mysqli_connect("localhost","root","","mhsp");
if(!$con)
    die ("Connection Failed".mysqli_connect_error());
include 'components/navfixed.php'
?>
<section>
<?php 
$sql = "SELECT name, profession ,phone, address FROM specialist";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $sn = 0;
?>
<h1>Specialists</h1>
    <table>
        <tr>
            <th>S.N.</th>
            <th>Name</th>
            <th>Profession</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {    
    echo "<tr>";
    echo "<td>".++$sn."</td>";
    echo "<td>".$row["name"]."</td>";
    echo "<td>".$row["profession"]."</td>";
    echo "<td>".$row["phone"]."</td>";
    echo "<td>".$row["address"]."</td>";
    echo "</tr>";
    }
} else {
    echo "<h2>Oops! It looks like there are no resources available at the moment.</h2>";
    echo "<p>Check back later for updates, or feel free to explore other sections of the site.</p>";
}
$con->close();
?>
    </table>
</section>
</body>
</html>