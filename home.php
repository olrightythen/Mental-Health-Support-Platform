<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Support Platform</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/bg4.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            backdrop-filter: blur(25px);
            height: 100vh;
        }

        header {
            background-color: rgba(0, 0, 0, 0.175);
            backdrop-filter: blur(10px);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #fff;
            margin: 0;
            font-size: 1.8em;
        }

        header a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            font-size: 1.2em;
        }

        #content {
            text-align: center;
            padding: 100px 20px;
        }

        #content h1 {
            font-size: 3em;
            color: #9CFF2E;
            margin-bottom: 20px;
        }

        #content p {
            font-size: 1.2em;
            color: #B5FE83;
            margin-bottom: 40px;
        }

        .buttons {
            display: flex;
            justify-content: center;
        }

        .buttons a {
            display: inline-block;
            padding: 15px 30px;
            margin: 0 20px;
            text-decoration: none;
            color: #444;
            font-size: 1.2em;
            font-weight: bold;
            background-color: #00FFAB;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .buttons a:hover {
            background-color: #14C38E;
        }

        #admin-login {
            position: absolute;
            backdrop-filter: blur(10px);
            top: 10px;
            right: 10px;
            background-color: #211C6A;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            
        }

        #admin-login:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <h1>Mental Health Support Platform</h1>
        <a href="admin_login.php" id="admin-login">Admin Login</a>
    </header>

    <div id="content">
        <h1>Welcome to Mental Health Support Platform</h1>
        <p>Your journey to mental well-being starts here. We are here to support you.</p>
        
        <div class="buttons">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </div>
</body>
</html>
