<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_management_application";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handle user deletion
if (isset($_GET['delete_user'])) {
    $UserID = $_GET['delete_user'];
    $stmt = $connection->prepare("DELETE FROM users WHERE UserID = ?");
    $stmt->bind_param("i", $UserID);
    $stmt->execute();
    $stmt->close();
    header("Location: ?manage=users");
}

// Handle task deletion
if (isset($_GET['delete_task'])) {
    $TaskID = $_GET['delete_task'];
    $stmt = $connection->prepare("DELETE FROM tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $TaskID);
    $stmt->execute();
    $stmt->close();
    header("Location: ?manage=tasks");
}

// Handle user update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $UserID = $_POST['UserID'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Role = $_POST['Role'];

    $stmt = $connection->prepare("UPDATE users SET Username = ?, Email = ?, Password = ?, Role = ? WHERE UserID = ?");
    $stmt->bind_param("sssii", $Username, $Email, $Password, $Role, $UserID);

    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ?manage=users");
}

// Handle task update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_task'])) {
    $TaskID = $_POST['TaskID'];
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $DueDate = $_POST['DueDate'];
    $Priority = $_POST['Priority'];
    $Status = $_POST['Status'];
    $AssignedUserID = $_POST['AssignedUserID'];

    $stmt = $connection->prepare("UPDATE tasks SET Title = ?, Description = ?, DueDate = ?, Priority = ?, Status = ?, AssignedUserID = ? WHERE TaskID = ?");
    $stmt->bind_param("sssiiii", $Title, $Description, $DueDate, $Priority, $Status, $AssignedUserID, $TaskID);

    if ($stmt->execute()) {
        echo "Task updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ?manage=tasks");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: orange;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background-color: green;
        }

        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }

        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }

        header ul {
            padding: 0;
            list-style: none;
        }

        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }

        .table-container, .form-container {
            margin: 20px 0;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 8px;
        }

        form input[type="text"], form input[type="email"], form input[type="password"], form input[type="date"], form input[type="number"], form select, form textarea, form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background: #555;
        }

        .link-button {
            display: block;
            width: 200px;
            padding: 10px;
            text-align: center;
            background: #333;
            color: #fff;
            text-decoration: none;
            margin: 20px auto;
        }

        .link-button:hover {
            background: #555;
        }

        .back-to-dashboard {
            margin-top: 10px;
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .back-to-dashboard:hover {
            background-color: #555;
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: #333;
            padding: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
        }

        nav a:hover {
            background-color: #555;
        }

        .active {
            display: block;
        }

        .hidden {
            display: none;
        }

        .table-links a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            background-color: #f1f1f1;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }

        .table-links a:hover {
            background-color: #ddd;
        }
    </style>
    </head>
<body>
    <nav>
        <a href="#" onclick="showSection('tables')">Tables</a>
        <a href="users dashboard.php" onclick="showSection('users dashboard')">User Management</a>
        
        <a href="reports.php" onclick="showSection('reports')">Reports</a>
        
        <a href="logout.php" onclick="showSection('settings')">Logout</a>
    </nav>
    <div class="container">
        <div id="tables" class="section active">
            <marquee><p>Welcome To The Admin Dashboard.</p></marquee>
            <div class="table-links">
                <a href="assignments.php" onclick="showSection('assignments')">Assignments</a>
                <a href="attachments.php" onclick="showSection('attachments')">Attachments</a>
                <a href="comments.php" onclick="showSection('comments')">Comments</a>
                <a href="tasks.php" onclick="showSection('tasksTable')">Tasks</a>
                <a href="taskhistory.php" onclick="showSection('taskhistory')">Task History</a>
                <a href="tags.php" onclick="showSection('tags')">Tags</a>
                <a href="notifications.php" onclick="showSection('notificationsTable')">Notifications</a>
                <a href="taskdependencies.php" onclick="showSection('taskdependencies')">Task Dependencies</a>
                <a href="projects.php" onclick="showSection('projectsTable')">Projects</a>
                <a href="users.php" onclick="showSection('usersTable')">Users</a>
            </div>

</head>
<body>

<header>
    <div class="container">
        <h1>Task Management Application</h1>
        <ul>
            <li><a href="?">Dashboard</a></li>
            <li><a href="?manage=users">Manage Users</a></li>
            <li><a href="?manage=tasks">Manage Tasks</a></li>
        </ul>
    </div>
</header>

<div class="container">
    <?php if (!isset($_GET['manage'])): ?>
        <h2>Dashboard</h2>
        <a class="link-button" href="?manage=users">Manage Users</a>
        <a class="link-button" href="?manage=tasks">Manage Tasks</a>
    <?php elseif ($_GET['manage'] == 'users'): ?>
        <div class="table-container">
            <h2>Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $connection->query("SELECT * FROM users");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['UserID']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Role']}</td>
                            <td><a href='?manage=users&edit_user={$row['UserID']}'>Edit</a></td>
                            <td><a href='?manage=users&delete_user={$row['UserID']}' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_GET['edit_user'])): 
            $UserID = $_GET['edit_user'];
            $result = $connection->query("SELECT * FROM users WHERE UserID = $UserID");
            $user = $result->fetch_assoc();
        ?>
        <div class="form-container">
            <form method="post">
                
                <input type="hidden" name="UserID" value="<?php echo $user['UserID']; ?>">
                <label for="Username">Username:</label>
                <input type="text" name="Username" value="<?php echo $user['Username']; ?>" required>
                <label for="Email">Email:</label>
                <input type="email" name="Email" value="<?php echo $user['Email']; ?>" required>
                <label for="Password">Password:</label>
                <input type="password" name="Password" value="<?php echo $user['Password']; ?>" required>
                <label for="Role">Role:</label>
                <select name="Role" required>
                    <option value="1" <?php if ($user['Role'] == 1) echo 'selected'; ?>>Admin</option>
                    <option value="2" <?php if ($user['Role'] == 2) echo 'selected'; ?>>User</option>
                </select>
                <input type="submit" name="update_user" value="Update User">
            </form>
        </div>
        <?php endif; ?>
    <?php elseif ($_GET['manage'] == 'tasks'): ?>
        <div class="table-container">
            <h2>Tasks</h2>
            <table>
                <thead>
                    <tr>
                        <th>TaskID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assigned User</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $connection->query("SELECT tasks.*, users.Username FROM tasks LEFT JOIN users ON tasks.AssignedUserID = users.UserID");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['TaskID']}</td>
                            <td>{$row['Title']}</td>
                            <td>{$row['Description']}</td>
                            <td>{$row['DueDate']}</td>
                            <td>{$row['Priority']}</td>
                            <td>{$row['Status']}</td>
                            <td>{$row['Username']}</td>
                            <td><a href='?manage=tasks&edit_task={$row['TaskID']}'>Edit</a></td>
                            <td><a href='?manage=tasks&delete_task={$row['TaskID']}' onclick=\"return confirm('Are you sure you want to delete this task?');\">Delete</a></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_GET['edit_task'])): 
            $TaskID = $_GET['edit_task'];
            $result = $connection->query("SELECT * FROM tasks WHERE TaskID = $TaskID");
            $task = $result->fetch_assoc();
        ?>
        <div class="form-container">
            <form method="post">
                <input type="hidden" name="TaskID" value="<?php echo $task['TaskID']; ?>">
                <label for="Title">Title:</label>
                <input type="text" name="Title" value="<?php echo $task['Title']; ?>" required>
                <label for="Description">Description:</label>
                <textarea name="Description" required><?php echo $task['Description']; ?></textarea>
                <label for="DueDate">Due Date:</label>
                <input type="date" name="DueDate" value="<?php echo $task['DueDate']; ?>" required>
                <label for="Priority">Priority:</label>
                <input type="number" name="Priority" value="<?php echo $task['Priority']; ?>" required>
                <label for="Status">Status:</label>
                <input type="number" name="Status" value="<?php echo $task['Status']; ?>" required>
                <label for="AssignedUserID">Assigned User:</label>
                <select name="AssignedUserID" required>
                    <?php
                    $users = $connection->query("SELECT * FROM users");
                    while ($user = $users->fetch_assoc()) {
                        $selected = $task['AssignedUserID'] == $user['UserID'] ? 'selected' : '';
                        echo "<option value='{$user['UserID']}' $selected>{$user['Username']}</option>";
                    }
                    ?>
                </select>
                <input type="submit" name="update_task" value="Update Task">
            </form>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$connection->close();
?>
