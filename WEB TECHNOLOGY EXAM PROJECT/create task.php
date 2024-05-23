<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Task</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    form {
        max-width: 400px;
        margin: 0 auto;
    }
    input[type="text"], input[type="date"], select, textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        box-sizing: border-box;
    }
    input[type="number"] {
        width: calc(100% - 22px); /* Adjust width to leave space for spinner buttons */
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px; /* Add space between input and button */
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    .error {
        color: red;
    }
</style>
</head>
<body>

<h2>Add Task</h2>

<form id="taskForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" required>
    
    <label for="description">Description</label>
    <textarea id="description" name="description"></textarea>
    
    <label for="dueDate">Due Date</label>
    <input type="date" id="dueDate" name="dueDate" required>
    
    <label for="priority">Priority</label>
    <select id="priority" name="priority">
        <option value="1">Low</option>
        <option value="2">Medium</option>
        <option value="3">High</option>
    </select>
    
    <label for="status">Status</label>
    <select id="status" name="status">
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
    </select>
    
    <label for="assignedUserID">Assigned User ID</label>
    <input type="number" id="assignedUserID" name="assignedUserID" required>
    
    <input type="submit" value="Create Task">
</form>

<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_management_application";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['dueDate'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $assignedUserID = $_POST['assignedUserID'];

    // Validate data
    if (!empty($title) && !empty($dueDate) && !empty($assignedUserID)) {
        // Prepare and execute SQL statement to insert task into database
        $stmt = $conn->prepare("INSERT INTO tasks (Title, Description, DueDate, Priority, Status, AssignedUserID) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisi", $title, $description, $dueDate, $priority, $status, $assignedUserID);

        if ($stmt->execute()) {
            echo "New task created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
}

// Close database connection
$conn->close();
?>

</body>
</html>
