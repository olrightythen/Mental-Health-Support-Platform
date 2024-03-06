<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: ../home.php");
    exit();
}

$username = $_SESSION["username"];
// If the user is logged in, you can display the home page content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            overflow-x: hidden;
        }

        header {
            background: linear-gradient(to right, #333, #1a1a1a);
            color: #fff;
            padding: 15px;
            text-align: left;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            overflow: auto;
        }

        .logout {
            text-align: right;
            margin-right: 20px;
            float: right;
        }

        .logout a {
            color: #fff;
            text-decoration: none;
            padding: 5px 20px 10px 20px;
            background-color: #d9534f;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logout a:hover {
            background-color: #c9302c;
        }

        nav {
            width: 250px;
            background-color: #1a1a1a;
            padding-top: 20px;
            position: absolute;
            height: 100%;
            overflow: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        nav a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 15px;
            margin-bottom: 5px;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #333;
        }

        #resources, #specialist, #community {
            display: none;
        }
        
        section {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
    
    <script>
        function navigate(toggle) {
            var home = document.getElementById('home');
            var resources = document.getElementById('resources');
            var specialist = document.getElementById('specialist');
            var community = document.getElementById('community');

            if (toggle==="home") {
                home.style.display = 'block';
                resources.style.display = 'none';
                specialist.style.display = 'none';
                community.style.display = 'none';
            } else if(toggle==="resources") {
                home.style.display = 'none';
                resources.style.display = 'block';
                specialist.style.display = 'none';
                community.style.display = 'none';
            } else if(toggle==="specialist"){
                home.style.display = 'none';
                resources.style.display = 'none';
                specialist.style.display = 'block';
                community.style.display = 'none';
            }else {
                home.style.display = 'none';
                resources.style.display = 'none';
                specialist.style.display = 'none';
                community.style.display = 'block';
            }
        }
    </script>
</head>
<body>

<header>
    <div class="logout">
        <a href="../logout.php">Logout</a>
    </div>
    <h1>Mental Health Support Platform</h1>
</header>

<nav>
    <a onclick="navigate('home')" >Home</a>
    <a onclick="navigate('resources')" >Resources</a>
    <a onclick="navigate('specialist')" >Specialist Details</a>
    <a onclick="navigate('community')" >Community</a>
</nav>

<section id="home">
    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    
    <div>
        <h3>Featured Resources</h3>
        <p>Explore our curated collection of resources to support your mental health:</p>
        <ul>
            <li><a href="resources.php#article1">Article 1</a></li>
            <li><a href="resources.php#video2">Video 2</a></li>
            <li><a href="resources.php#podcast3">Podcast 3</a></li>
        </ul>
    </div>

    <div>
        <h3>Find a Specialist</h3>
        <p>Connect with mental health specialists who can help you on your journey:</p>
        <ul>
            <li><a href="specialist.php#psychologist">Psychologists</a></li>
            <li><a href="specialist.php#therapist">Therapists</a></li>
            <li><a href="specialist.php#counselor">Counselors</a></li>
        </ul>
    </div>

    <div>
        <h3>Community Discussions</h3>
        <p>Engage with our supportive community to share experiences and insights:</p>
        <ul>
            <li><a href="community.php#general">General Discussions</a></li>
            <li><a href="community.php#selfcare">Self-Care Tips</a></li>
            <li><a href="community.php#inspiration">Inspiration Corner</a></li>
        </ul>
    </div>

    <p>Feel free to navigate through the links in the sidebar to explore different sections of the platform.</p>
</section>

<section id="resources">
        <?php
        include("resources.php");
        ?>
</section>

<section id="specialist">
        <?php
        include("specialist.php");
        ?>
</section>

<section id="community">
        <?php
        include("community.php");
        ?>
</section>

</body>
</html>
