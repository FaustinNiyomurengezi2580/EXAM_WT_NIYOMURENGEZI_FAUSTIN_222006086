<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Assignments</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body style="background-image: url('./Images/LECTA.jpg');background-repeat: no-repeat;background-size:cover;">

<header>
  <ul>
    <li><img src="./logo.jpg" width="90" height="60" alt="Logo"></li>
    <li><a href="./assignments.php">Assignments</a></li>
    <li><a href="./comments.php">Comments</a></li>
    <li><a href="./attachments.php">Attachments</a></li>
    <li><a href="./tasks.php">Tasks</a></li>
    <li><a href="./taskdependencies.php">TasksDependencies</a></li>
    <li><a href="./taskhistory.php">TasksHistory</a></li>
    <li><a href="./notifications.php">Notifications</a></li>
    <li><a href="./users.php">Users</a></li>
    <li><a href="./tags.php">Tags</a></li>
    <li><a href="./projects.php">Projects</a></li>
    <li><a href="logout.php" style="color: darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Logout</a></li>
    <br><br>
  </ul>
</header>

<?php
// Include database connection
include('database_connection.php');

// Inserting records
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $AssignmentID = intval($_POST['AssignmentID']);
    $ProjectID = intval($_POST['ProjectID']);
    $TaskID = intval($_POST['TaskID']);
    $AssignedUserID = intval($_POST['AssignedUserID']);

    $stmt = $connection->prepare("INSERT INTO assignments (AssignmentID, ProjectID, TaskID, AssignedUserID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $AssignmentID, $ProjectID, $TaskID, $AssignedUserID);

    if ($stmt->execute()) {
        echo "New record has been added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close statement, not connection
}

// Deleting records
if (isset($_GET['delete'])) {
    $AssignmentID = intval($_GET['delete']);
    $stmt = $connection->prepare("DELETE FROM assignments WHERE AssignmentID = ?");
    $stmt->bind_param("i", $AssignmentID);

    if ($stmt->execute()) {
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close statement, not connection
}

// Updating records
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $AssignmentID = intval($_POST['AssignmentID']);
    $ProjectID = intval($_POST['ProjectID']);
    $TaskID = intval($_POST['TaskID']);
    $AssignedUserID = intval($_POST['AssignedUserID']);

    $stmt = $connection->prepare("UPDATE assignments SET ProjectID = ?, TaskID = ?, AssignedUserID = ? WHERE AssignmentID = ?");
    $stmt->bind_param("iiii", $ProjectID, $TaskID, $AssignedUserID, $AssignmentID);

    if ($stmt->execute()) {
        echo "Record updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetching records for display
$sql = "SELECT * FROM assignments";
$result = $connection->query($sql);

// Display assignment records
echo "<h2>Table of Assignments</h2>";
echo "<table border='1'>";
echo "<tr><th>AssignmentID</th><th>ProjectID</th><th>TaskID</th><th>AssignedUserID</th><th>Delete</th><th>Update</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['AssignmentID'] . "</td>
                <td>" . $row['ProjectID'] . "</td>
                <td>" . $row['TaskID'] . "</td>
                <td>" . $row['AssignedUserID'] . "</td>
                <td><a href='?delete=" . $row['AssignmentID'] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>
                <td><a href='?update=" . $row['AssignmentID'] . "'>Update</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No data found</td></tr>";
}

echo "</table>";

// Check if an update request is made
if (isset($_GET['update'])) {
    $AssignmentID = intval($_GET['update']);
    $sql = "SELECT * FROM assignments WHERE AssignmentID = $AssignmentID";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

<!-- Update Form -->
<h2>Update Form</h2>
<form method="post">
    <input type="hidden" name="AssignmentID" value="<?php echo $row['AssignmentID']; ?>">
    <label for="ProjectID">ProjectID:</label>
    <input type="number" id="ProjectID" name="ProjectID" value="<?php echo $row['ProjectID']; ?>" required><br><br>

    <label for="TaskID">TaskID:</label>
    <input type="number" id="TaskID" name="TaskID" value="<?php echo $row['TaskID']; ?>" required><br><br>

    <label for="AssignedUserID">AssignedUserID:</label>
    <input type="number" id="AssignedUserID" name="AssignedUserID" value="<?php echo $row['AssignedUserID']; ?>" required><br><br>

    <input type="submit" name="update" value="Update">
</form>

<?php
    }
}
?>

<!-- Assignments Form -->
<h1>Assignments Form</h1>
<form id="assignmentForm" method="post">
    <label for="AssignmentID">AssignmentID:</label>
    <input type="number" id="AssignmentID" name="AssignmentID"><br><br>

    <label for="ProjectID">ProjectID:</label>
    <input type="number" id="ProjectID" name="ProjectID" required><br><br>

    <label for="TaskID">TaskID:</label>
    <input type="number" id="TaskID" name="TaskID" required><br><br>

    <label for="AssignedUserID">AssignedUserID:</label>
    <input type="number" id="AssignedUserID" name="AssignedUserID" required><br><br>

    <input type="submit" name="add" value="Insert" onclick="return confirmInsertion();">
</form>

<!-- JavaScript code for form submission confirmation -->
<script>
    function confirmInsertion() {
        return confirm("Are you sure you want to insert this record?");
    }
</script>

</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
