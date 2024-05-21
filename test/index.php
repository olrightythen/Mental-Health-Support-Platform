<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Mental Health Support Platform</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
            color: #333;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Header Styles */
        header {
            background: linear-gradient(90deg, #007BFF, #0056b3);
            color: white;
            padding: 1rem;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header .logout {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        header .logout a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border: 2px solid white;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        header .logout a:hover {
            background-color: white;
            color: #007BFF;
        }

        /* Navigation Styles */
        nav {
            background-color: #343a40;
            width: 250px;
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 4rem;
            /* Ensure this matches the height of the header */
            left: 0;
            bottom: 0;
            padding-top: 3rem;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            transition: width 0.3s ease;
            overflow-y: auto;
            /* Ensure contents are scrollable */
        }

        nav:hover {
            width: 280px;
        }

        nav a {
            color: white;
            padding: 1rem 1.5rem;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s, padding-left 0.3s;
            border-bottom: 1px solid #495057;
        }

        nav a:hover {
            background-color: #495057;
            color: #ffcc00;
            /* Highlight color */
            padding-left: 2rem;
        }

        /* Main Content Styles */
        main {
            margin-left: 250px;
            /* Same as nav width */
            padding: 5rem 2rem 2rem 2rem;
            /* Adjusted padding for fixed header and nav */
            flex: 1;
            transition: margin-left 0.3s ease;
        }

        nav:hover+main {
            margin-left: 280px;
        }

        /* Footer Styles */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-left: 250px;
            /* Same as nav width */
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        nav:hover+main+footer {
            margin-left: 280px;
            width: calc(100% - 280px);
        }

        /* Responsive Design */
        @media (max-width: 800px) {
            nav {
                width: 100%;
                height: auto;
                position: relative;
                top: 0;
                box-shadow: none;
                padding-top: 0;
            }

            nav a {
                float: none;
                text-align: left;
            }

            main,
            footer {
                margin-left: 0;
                padding: 4rem 1rem 1rem 1rem;
                /* Adjusted padding for smaller screens */
            }

            header .logout {
                position: static;
                text-align: center;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
        <h1>Mental Health Support Platform</h1>
    </header>

    <nav>
        <a href="dashboard.php">Home</a>
        <a href="resources.php">Resources</a>
        <a href="specialist.php">Specialist Details</a>
        <a href="community.php">Community</a>
    </nav>

    <main>
        Main content
    </main>
</body>

</html>