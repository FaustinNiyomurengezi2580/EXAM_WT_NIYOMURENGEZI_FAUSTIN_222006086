<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "task_management_application";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare and bind the update statement
    $stmt = $conn->prepare("UPDATE tasks SET Title=?, Description=? WHERE TaskID=?");

    // Bind the parameters
    $stmt->bind_param("ssi", $updatedTask, $updatedDescription, $taskID);

    // Sanitize the input
    $updatedTask = htmlspecialchars($_POST['task']);
    $updatedDescription = htmlspecialchars($_POST['description']);
    $taskID = $_POST['taskID'];

    $stmt->execute();

    // Close statement
    $stmt->close();

    echo "Task updated successfully";
}

// Close connection
$conn->close();
?>

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
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .task {
            background-color: pink;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .task h3 {
            color: #333;
            margin-top: 0;
        }

        .task p {
            color: #666;
        }

        .task button {
            background-color: orange;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .task button:hover {
            background-color: #ff6600;
        }

        form {
            display: none;
        }

        form.active {
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0066ff;
        }

        footer {
            background-color: green;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>View Tasks</h1>
    </header>

    <div class="container">
        <?php
        // PHP code to generate tasks...
        ?>
    </div>

    <footer>
        &copy; 2024 Task Management Application
    </footer>
</body>
</html>

    </style>


    
        <?php
        // PHP code to generate tasks
        $tasks = [
            ["TaskID" => 1, "title" => "Time Tracking", "description" => "Monitor the time spent on each task and project."],
            ["TaskID" => 2, "title" => "Document Management", "description" => "Store, organize, and share documents."],
            ["TaskID" => 3, "title" => "Analytics and Reporting", "description" => "Gain insights into team performance."],
            ["TaskID" => 4, "title" => "Notifications and Reminders", "description" => "Stay updated with real-time notifications."],
            ["TaskID" => 5, "title" => "Integration with Other Tools", "description" => "Integrate with email, calendars, and more."],
            ["TaskID" => 6, "title" => "Mobile Access", "description" => "Manage tasks on the go with our mobile app."],
            ["TaskID" => 7, "title" => "Project Planning", "description" => "Plan and schedule tasks effectively."],
            ["TaskID" => 8, "title" => "Team Collaboration", "description" => "Collaborate with team members in real-time."],
            ["TaskID" => 9, "title" => "Task Prioritization", "description" => "Prioritize tasks to focus on what's important."],
            ["TaskID" => 10, "title" => "Resource Allocation", "description" => "Allocate resources efficiently to tasks and projects."]
        ];

        foreach ($tasks as $task) {
            echo "<div class='task'>
                    <h3>{$task['title']}</h3>
                    <p>{$task['description']}</p>
                    <button onclick=\"document.getElementById('form-{$task['TaskID']}').style.display='block'\">Update</button>
                    <form id='form-{$task['TaskID']}' action='' method='POST'>
                        <input type='hidden' name='taskID' value='{$task['TaskID']}'>
                        <input type='text' name='task' value='{$task['title']}' required>
                        <textarea name='description' required>{$task['description']}</textarea>
                        <button type='submit'>Save</button>
                    </form>
                  </div>";
        }
        ?>
    </div>

    <footer>
        &copy; 2024 Task Management Application
    </footer>
</body>
</html>
