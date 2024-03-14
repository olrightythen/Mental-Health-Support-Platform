<?php
include 'components/navfixed.php';
?>
<section>
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
</body>
</html>