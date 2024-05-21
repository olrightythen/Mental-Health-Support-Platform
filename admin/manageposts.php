<?php
$con = mysqli_connect("localhost", "root", "", "mhsp");
if (!$con)
    die("Connection Failed" . mysqli_connect_error());
include '../components/adminnavfixed.php'
?>
<section>
    <?php
    $sql = "SELECT id, title, description, date, user_id FROM experiences ORDER BY id DESC";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <h1>All Posts</h1>
        <table>
            <tr>
                <th>I.D.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>User I.D.</th>
                <th>Action</th>
            </tr>
        <?php
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td><a class='btn btndelete' id=" . $row['id'] . ">Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<h2>Oops! It looks like there are no posts available</h2>";
    }
    $con->close();
        ?>
        </table>
</section>
<script>
    var x = document.querySelectorAll(".btndelete");
    x.forEach(del => {
        del.addEventListener("click", () => {
            var li = del.getAttribute("id");
            var check = confirm("Do you want to delete this post?");
            if (check === true) {
                let url = "../components/delete.php?id=" + li + "&tbl=posts&redirect=admin/manageposts.php";
                window.location.replace(url);
            }
        });
    });
</script>
</body>

</html>