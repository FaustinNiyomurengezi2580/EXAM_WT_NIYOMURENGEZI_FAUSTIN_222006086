<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Application</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: blue;
             background-image: url('wallpp.jpg');
        }

        header {
            background-color: brown ;
            color: skyblue;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 24px; /* Smaller title size */
        }

        h2 {
            margin: 0;
            font-size: 20px; /* Smaller subtitle size */
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 10px; /* Less margin between items */
        }

        nav ul li a {
            text-decoration: none;
            color: lightyellow;
            padding: 5px 10px;
            font-size: 14px; /* Smaller font size */
            border: 1px solid #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #555;
        }

        .logoutbtn {
            background-color: yellow;
            color: #333;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 14px; /* Smaller font size */
        }

        .logoutbtn:hover {
            background-color: #ffd700;
        }

        footer {
            background-color: blue;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .marquee {
            animation: marquee 20s linear infinite;
            white-space: nowrap;
            overflow: hidden;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Task Management Application</h1>
        <h2><marquee> Welcome To User Dashboard</marquee></h2>
        <nav>
            <ul>
                <li><a href="home.html" id="homeBtn">Home</a></li>
                <li><a href="about us.html" id="about usBtn">about us</a></li>
                <li><a href="contact us.html" id="contact usBtn">contact us</a></li>

                <li><a href="create task.php" id="createTaskBtn">Create Task</a></li>
                <li><a href="viewtasks.php" id="viewtasksBtn">View Tasks</a></li>
                <li><a href="updatetasks.php" id="updatetasksBtn">Update Tasks</a></li>
                <li><a href="userprofile.php" id="userprofileBtn">User Profile</a></li>
                <li><a href="taskshistory.php" id="taskHistoryBtn">Task History</a></li>
               
            </ul>
        </nav>
    </header>
    
    <div class="search-form" style="text-align: right; padding: 15px;">
        <form role="search" action="tasksnotifications.php" method="get">
            <input class="form-control" type="search" placeholder="Search..." aria-label="Search" name="query">
            <button class="btn" type="submit">Search</button>
        </form>
        <form action="logout.php" method="post" style="display:inline;">
            <input type="submit" value="Logout" class="logoutbtn">
        </form>
    </div>

    <footer>
        <div class="marquee">
            <b><h2>DESIGNED BY FAUSTIN NIYOMURENGEZI UR CBE BIT &copy, 2024 &reg, @WEB TECHNOLOGY</h2></b>
        </div>
    </footer>
</body>
</html>
