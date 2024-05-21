<?php
$conn = mysqli_connect("localhost", "root", "", "mhsp");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

include 'components/navfixed.php';

// Check if there is a logged-in user
$current_user = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Handle form submission for filtering experiences
$filter_user_posts = isset($_POST['filter_user_posts']) ? $_POST['filter_user_posts'] : null;

$empty_message = null;

if ($filter_user_posts && $current_user) {
    // Get user_id from users table based on the username
    $user_sql = "SELECT id FROM users WHERE name = '$current_user'";
    $user_result = $conn->query($user_sql);

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['id'];

        // Fetch experiences from the current logged-in user
        $sql = "SELECT p.id, p.title, p.description, p.date, p.user_id, u.name 
                FROM experiences p
                JOIN users u ON p.user_id = u.id
                WHERE p.user_id = '$user_id'";
    }

    $empty_message = "<p>You haven't shared any experiences yet.</p>";
} else {
    // Fetch all experiences from the database
    $sql = "SELECT p.id, p.title, p.description, p.date, p.user_id, u.name 
            FROM experiences p
            JOIN users u ON p.user_id = u.id";

    $empty_message = "<p>There are no experiences available at the moment.</p>";
}

$result = $conn->query($sql);

// Handle form submission for adding a new post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_post'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $username = $_SESSION['username'];

    // Get user_id from users table based on the username
    $user_sql = "SELECT id FROM users WHERE name = '$username'";
    $user_result = $conn->query($user_sql);

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['id'];

        // Insert the new post into the database
        $sql = "INSERT INTO experiences (title, description, date, user_id) VALUES ('$title', '$description', NOW(), '$user_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New post added successfully</p>";
            header('Location: community.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User not found.";
    }
}
?>
<section>
    <h1>Community Posts</h1>
    <p>Share your experience, thoughts, and questions with the community.</p>
    <div class="before-experiences">
        <button class="add-post-btn" onclick="openModal()">Add Post</button>
        <form method="POST" action="community.php">
            <input type="checkbox" id="filter_user_posts" name="filter_user_posts" value="1" onchange="this.form.submit()" <?php if ($filter_user_posts) echo 'checked'; ?>>
            <label for="filter_user_posts">Show My Posts Only</label>
        </form>
    </div>
    <div class="experiences">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $post_id = $row["id"];
                $is_current_user = ($current_user && $row["name"] == $current_user);
                echo '<div class="post">';
                if ($is_current_user) {
                    echo '<div class="menu" onclick="toggleDropdown(' . $post_id . ')"><span class="dots">⋮</span></div>';
                    echo '<div id="dropdown-' . $post_id . '" class="dropdown">
                                <a onclick="deletePost(' . $post_id . ')" >Delete</a>
                      </div>';
                }
                echo '<h2>' . $row["title"] . '</h2>';
                echo '<div class="post-info">';
                echo 'Posted by ' . ($is_current_user ? 'You' : $row["name"]) . ' on ' . $row["date"];
                echo '</div>';
                echo '<p>' . $row["description"] . '</p>';
                // Add comments section here
                echo '</div>';
            }
        } else {
            echo $empty_message;
        }
        $conn->close();
        ?>
    </div>
</section>
<!-- The Modal -->
<div id="postModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form class="modal-form" method="POST" action="community.php">
            <h2>Add New Post</h2>
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="description" placeholder="Description" rows="4" required></textarea>
            <button type="submit" name="add_post">Post</button>
        </form>
    </div>
</div>
<script>
    function deletePost(id) {
        var check = confirm("Do you want to delete this post?");
        if (check == true) {
            window.location = "components/delete.php?id=" + id + "&tbl=experiences&redirect=community.php";
        }
    }

    function toggleDropdown(id) {
        var dropdown = document.getElementById("dropdown-" + id);
        var isDisplayed = dropdown.style.display === "block";
        document.querySelectorAll(".dropdown").forEach(function(el) {
            el.style.display = "none";
        });
        if (!isDisplayed) {
            dropdown.style.display = "block";
        }
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.menu')) {
            document.querySelectorAll('.dropdown').forEach(function(el) {
                el.style.display = 'none';
            });
        }
    });

    function openModal() {
        document.getElementById('postModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('postModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('postModal')) {
            document.getElementById('postModal').style.display = 'none';
        }
    }
</script>
</body>

</html>