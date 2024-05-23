<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Task</title>
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
        width: calc(100% - 22px);
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    .error {
        color: red;
    }
    .success {
        color: green;
    }
</style>
</head>
<body>

<?php
// Define variables and initialize with empty values
$taskId = $title = $description = $DueDate = $priority = $status = $AssignedUserID = "";
$titleErr = $dueDateErr = $AssignedUserIDErr = "";
$updateMessage = "";

// Check if the task ID is provided via GET request for the initial form load
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["taskId"])) {
    $taskId = $_GET["taskId"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "task_management_application";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the task details
    $sql = "SELECT * FROM tasks WHERE TaskID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $description = $row["description"];
        $dueDate = $row["DueDate"];
        $priority = $row["priority"];
        $status = $row["status"];
        $assignedUserID = $row["AssignedUserID"];
    } else {
        echo "<p class='error'>Task not found.</p>";
        exit();
    }

    $stmt->close();
    $conn->close();
}

// Process form when it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "task_management_application";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate form data
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    } else {
        $title = $_POST["title"];
    }

    if (empty($_POST["dueDate"])) {
        $dueDateErr = "Due Date is required";
    } else {
        $dueDate = $_POST["dueDate"];
    }

    if (empty($_POST["AssignedUserID"])) {
        $assignedUserIDErr = "Assigned User ID is required";
    } else {
        $AssignedUserID = $_POST["AssignedUserID"];
    }

    // Proceed if no validation errors
    if (empty($titleErr) && empty($dueDateErr) && empty($assignedUserIDErr)) {
        $taskId = $_POST["taskId"];
        $description = $_POST["description"];
        $priority = $_POST["priority"];
        $status = $_POST["status"];

        // Prepare and bind
        // Prepare and bind
$stmt = $conn->prepare("UPDATE tasks SET Title=?, Description=?, DueDate=?, Priority=?, Status=?, AssignedUserID=? WHERE TaskID=?");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("sssissi", $title, $description, $dueDate, $priority, $status, $assignedUserID, $taskId);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("sssissi", $title, $description, $DueDate, $priority, $status, $AssignedUserID, $taskId);

        // Execute the statement
        if ($stmt->execute()) {
            $updateMessage = "Task updated successfully";
        } else {
            $updateMessage = "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<h2>Update Task</h2>

<?php
if (!empty($updateMessage)) {
    echo '<p class="' . (strpos($updateMessage, 'successfully') !== false ? 'success' : 'error') . '">' . $updateMessage . '</p>';
}
?>

<form id="updateTaskForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" id="taskId" name="taskId" value="<?php echo htmlspecialchars($taskId); ?>">

    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
    <span class="error"><?php echo $titleErr; ?></span>

    <label for="description">Description</label>
    <textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>

    <label for="dueDate">Due Date</label>
    <input type="date" id="dueDate" name="dueDate" value="<?php echo htmlspecialchars($dueDate); ?>" required>
    <span class="error"><?php echo $dueDateErr; ?></span>

    <label for="priority">Priority</label>
    <select id="priority" name="priority">
        <option value="1" <?php if ($priority == 1) echo 'selected'; ?>>Low</option>
        <option value="2" <?php if ($priority == 2) echo 'selected'; ?>>Medium</option>
        <option value="3" <?php if ($priority == 3) echo 'selected'; ?>>High</option>
    </select>

    <label for="status">Status</label>
    <select id="status" name="status">
        <option value="Pending" <?php if ($status == "Pending") echo 'selected'; ?>>Pending</option>
        <option value="In Progress" <?php if ($status == "In Progress") echo 'selected'; ?>>In Progress</option>
        <option value="Completed" <?php if ($status == "Completed") echo 'selected'; ?>>Completed</option>
    </select>

    <label for="AssignedUserID">AssignedUserID</label>
    <input type="number" id="AssignedUserID" name="AssignedUserID" value="<?php echo htmlspecialchars($AssignedUserID); ?>" required>
    <span class="error"><?php echo $AssignedUserIDErr; ?></span>

    <input type="submit" value="Update Task">
</form>

</body>
</html>
