<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Recruiter Panel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic CSS Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #333;
            color: white;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
        }

        .logo a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2em;
        }

        .nav-links {
            list-style: none;
        }

        .nav-links li {
            display: inline;
            margin-right: 20px;
        }

        .nav-links li a {
            color: white;
            text-decoration: none;
        }

        .nav-links li a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#">Recruiter Panel</a>
            </div>
            <ul class="nav-links">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Jobs</a></li>
                <li><a href="#">Candidates</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </nav>

   

    <!-- Rest of your recruiter panel content -->
    <main class="py-4">
        @yield('content')
    </main>
</body>

</html>
