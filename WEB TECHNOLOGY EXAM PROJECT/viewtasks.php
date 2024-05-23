<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tasks</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .task {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .task h3 {
            margin-top: 0;
        }

        .task p {
            margin: 5px 0;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>View Tasks</h1>
    </header>

    <div class="container">
        <?php
        // PHP code to generate tasks
        $tasks = [
            "Time Tracking" => "Monitor the time spent on each task and project.",
            "Document Management" => "Store, organize, and share documents.",
            "Analytics and Reporting" => "Gain insights into team performance.",
            "Notifications and Reminders" => "Stay updated with real-time notifications.",
            "Integration with Other Tools" => "Integrate with email, calendars, and more.",
            "Mobile Access" => "Manage tasks on the go with our mobile app.",
            "Project Planning" => "Plan and schedule tasks effectively.",
            "Team Collaboration" => "Collaborate with team members in real-time.",
            "Task Prioritization" => "Prioritize tasks to focus on what's important.",
            "Resource Allocation" => "Allocate resources efficiently to tasks and projects."
        ];

        foreach ($tasks as $task => $description) {
            echo "<div class='task'>
                    <h3>$task</h3>
                    <p>$description</p>
                  </div>";
        }
        ?>
    </div>

    <footer>
        &copy; 2024 Task Management Application
    </footer>
</body>
</html>
