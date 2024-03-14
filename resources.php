<?php
$con = mysqli_connect("localhost","root","","mhsp");
if(!$con)
    die ("Connection Failed".mysqli_connect_error());
include 'components/navfixed.php'
?>
<section>
<?php 
    $sql = "SELECT title, description ,link FROM resources";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $sn = 0;
?>
    <h1>Available Resources</h1>
    <table>
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Description</th>
        </tr>
<?php        
        // output data of each row
        while($row = $result->fetch_assoc()) {
        
        echo "<tr>";
        echo "<td>".++$sn."</td>";
        echo "<td><a href='".$row["link"]."' target='_'>".$row["title"]."</a></td>";
        echo "<td>".$row["description"]."</td>";
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
