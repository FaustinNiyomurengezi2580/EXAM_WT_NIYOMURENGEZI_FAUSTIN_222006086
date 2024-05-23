<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TASKS MANAGEMENT APPLICATION PLATFORM</title>
     <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: skyblue;
            color: black;
        }

        .navbar {
            background-color:orange;
            padding: 1em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: white;
            text-decoration: none;
            font-size: 1.5em;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 1em;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links .dropdown {
            position: relative;
        }

        .nav-links .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .nav-links .dropdown:hover .dropdown-content {
            display: block;
        }

        .nav-links .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .nav-links .dropdown-content a:hover {
            background-color: #ddd;
        }

        .hero-section {
            background-image: url('image/a.jpg');
            background-size: cover;
            background-color: royalblue;
            background-position: center;
            background-repeat: no-repeat;
            padding: 60px 0;
            text-align: center;
            color: white;
        }

        .hero-section .cta-form input {
            padding: 0.5em;
            margin-right: 1em;
            border: none;
            border-radius: 5px;
        }

        .hero-section .cta-form button {
            padding: 0.5em;
            background-color: greenyellow;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .hero-section .cta-form button:hover {
            background-color: lightpink;
        }

        .features-section {
            padding: 40px 0;
            background-color: #fff;
            text-align: center;
        }

        .feature-boxes {
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        .feature {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        .feature i {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .about-section {
            padding: 40px 0;
            background-color: orange;
            text-align: center;
        }

        .about-section .btn {
            padding: 10px 20px;
            background-color: orange;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .about-section .btn:hover {
            background-color: tomato;
        }

        .category-section {
            padding: 40px 0;
            background-color: white;
        }

        .category-boxes {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            text-align: center;
        }

        .category {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .category:hover {
            transform: translateY(-10px);
        }

        .category i {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .footer {
            background-color:blue;
            color: white;
            padding: 20px 0;
        }

        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer .left-part p,
        .footer .right-part p {
            margin: 0;
        }

        .footer a {
            color: black;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <header>
        <nav class="navbar">
            <a href="index.php" class="navbar-brand">TMA</a>
            <ul class="nav-links">
                <li><a href="home.html">Home</a></li>
                <li><a href="about us.html">About Us</a></li>
                <li><a href="contact us.html">Contact us</a></li>
                <li><a href="admin login.php">Admin Login</a></li>
                <li class="dropdown">
                    <a href="login.php">User Login &#9662;</a>
                    <div class="dropdown-content">
                        <a href="register.php">Register</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main Content Section -->
    
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Welcome To Tasks Management Application Platform</h1>
                <p>Get started today and experience the benefits of better task management!</p>
                <div class="cta-form">
                    <input type="text" placeholder="Enter your email address">
                    <!-- Modified line to include login link -->
                    <a href="login.php"><button>Get Started</button></a>
                </div>
            </div>
        </div>

    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="feature-boxes">
                <div class="feature">
                    <i class="fa fa-users"></i>
                    <h2>Organizing Tasks</h2>
                    <p> Helps users structure and prioritize their work by organizing tasks into categories, projects, or lists.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-book"></i>
                    <h2>User-Friendly Interface</h2>
                    <p>A clean, intuitive design makes it easy for users to navigate and manage their tasks without a steep learning curve</p>
                </div>
                <div class="feature">
                    <i class="fa fa-certificate"></i>
                    <h2>Enhancing Collaboration</h2>
                    <p>Facilitates teamwork by allowing multiple users to collaborate on tasks, share updates, and communicate within the app.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-smile-o"></i>
                    <h2>Increasing Productivity</h2>
                    <p>Boosts overall productivity by providing a centralized platform where users can manage all their tasks, reducing the time spent on switching between different tools.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <h2>About Us</h2>
                <p>Discover our mission and the benefits of joining our platform.</p>
                <a href="about us.html" class="btn">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Category Section -->
    <section class="category-section">
        <div class="container">
            <div class="category-boxes">
                <div class="category">
                    <i class="fa fa-money"></i>
                    <h3>Reducing Overwhelm</h3>
                    <p>Simplifies complex projects by breaking them down into manageable tasks, making it easier for users to focus and avoid feeling overwhelmed.</p>
                </div>
                <div class="category">
                    <i class="fa fa-line-chart"></i>
                    <h3>Meeting Deadlines</h3>
                    <p>Helps users stay on top of deadlines by sending reminders and notifications about upcoming due dates and overdue tasks.
</p>
                </div>
                <div class="category">
                    <i class="fa fa-piggy-bank"></i>
                    <h3>Task Prioritization and Labels</h3>
                    <p>Allows users to prioritize tasks and use labels or tags to categorize and filter tasks, making it easier to focus on what’s most important..</p>
                </div>
                <div class="category">
                    <i class="fa fa-credit-card"></i>
                    <h3>Enhancing Accountability</h3>
                    <p>Promotes accountability by clearly assigning tasks to specific team members and tracking their completion status.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="left-part">
                <p class="mb-0">Designed by Trained Tasks Management Experts</p>
                <p class="mb-0">UR, RN1-HUYE</p>
                <p class="mb-0">contact@TaskManagementPlatform.com</p>
                <p class="mb-0">+250 784933362/ +25090998550</p>
            </div>
            <div class="right-part">
                <p class="mb-0">© 2024 Business Strategy Platform. All rights reserved.</p>
                <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Faustin</a></p>
                <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Faustin</a></p>
            </div>
        </div>
    </footer>

    <!-- Add JavaScript links if needed -->
    <script src="script.js"></script>
</body>

</html>
