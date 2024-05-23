<?php
// Database connection settings
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Insert new record
        $stmt = $connection->prepare("INSERT INTO taskdependencies (DependentTaskID, PrerequisiteTaskID) VALUES (?, ?)");
        $stmt->bind_param("ii", $DependentTaskID, $PrerequisiteTaskID);
        
        $DependentTaskID = intval($_POST['DependentTaskID']);
        $PrerequisiteTaskID = intval($_POST['PrerequisiteTaskID']);

        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['update'])) {
        // Update existing record
        $stmt = $connection->prepare("UPDATE taskdependencies SET DependentTaskID=?, PrerequisiteTaskID=? WHERE DependencyID=?");
        $stmt->bind_param("iii", $DependentTaskID, $PrerequisiteTaskID, $DependencyID);

        $DependentTaskID = intval($_POST['DependentTaskID']);
        $PrerequisiteTaskID = intval($_POST['PrerequisiteTaskID']);
        $DependencyID = intval($_POST['DependencyID']);

        if ($stmt->execute()) {
            echo "Record updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

if (isset($_GET['delete'])) {
    // Delete existing record
    $stmt = $connection->prepare("DELETE FROM taskdependencies WHERE DependencyID=?");
    $stmt->bind_param("i", $DependencyID);

    $DependencyID = intval($_GET['DependencyID']);

    if ($stmt->execute()) {
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TaskDependencies Page</title>
  /* CSS styles */
  <style>
    /* CSS styles */
body {
  background-image: url('./Images/LECTA.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  font-family: Arial, sans-serif;
  background-color: pink;
}

header ul {
  list-style-type: none;
  padding: 0;
  text-align: center;
}

header ul li {
  display: inline;
  margin-right: 10px;
}

header ul li a {
  padding: 10px 20px;
  color: white;
  background-color: darkgreen;
  text-decoration: none;
  border-radius: 10px;
  transition: background-color 0.3s;
}

header ul li a:hover {
  background-color: green;
}

header ul li img {
  vertical-align: middle;
}

section {
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  max-width: 600px;
  margin: auto;
}

/* Specific styling for the TaskDependencies form */
form#TaskDependenciesForm {
  background-color: yellow; /* Add yellow background color */
  padding: 20px;
  border-radius: 10px;
}

form#TaskDependenciesForm label {
  display: block;
  margin-top: 10px;
}

form#TaskDependenciesForm input[type="number"],
form#TaskDependenciesForm input[type="text"],
form#TaskDependenciesForm textarea {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#TaskDependenciesForm input[type="date"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#TaskDependenciesForm input[type="submit"] {
  margin-top: 20px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: darkgreen;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s;
}

form#TaskDependenciesForm input[type="submit"]:hover {
  background-color: green;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: orange;
}

table, th, td {
  border: 1px solid black;
}

th, td {
  padding: 10px;
  text-align: center;
}

footer {
  text-align: center;
  margin-top: 20px;
}

body {
  background-image: url('./Images/LECTA.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  font-family: Arial, sans-serif;
  background-color: pink;
}

header ul {
  list-style-type: none;
  padding: 0;
  text-align: center;
}

header ul li {
  display: inline;
  margin-right: 10px;
}

header ul li a {
  padding: 10px 20px;
  color: white;
  background-color: darkgreen;
  text-decoration: none;
  border-radius: 10px;
  transition: background-color 0.3s;
}

header ul li a:hover {
  background-color: green;
}

header ul li img {
  vertical-align: middle;
}

section {
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  max-width: 600px;
  margin: auto;
}

/* Specific styling for the TaskDependencies form */
form#TaskDependenciesForm {
  background-color: yellow; /* Add yellow background color */
  padding: 20px;
  border-radius: 10px;
}

form#TaskDependenciesForm label {
  display: block;
  margin-top: 10px;
}

form#TaskDependenciesForm input[type="number"],
form#TaskDependenciesForm input[type="text"],
form#TaskDependenciesForm textarea {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#TaskDependenciesForm input[type="date"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#TaskDependenciesForm input[type="submit"] {
  margin-top: 20px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: darkgreen;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s;
}

form#TaskDependenciesForm input[type="submit"]:hover {
  background-color: green;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: orange;
}

table, th, td {
  border: 1px solid black;
}

th, td {
  padding: 10px;
  text-align: center;
}

footer {
  text-align: center;
  margin-top: 20px;
}
</style>
  <script>
    function confirmInsertion() {
      return confirm("Are you sure you want to insert this record?");
    }

    function confirmUpdate() {
      return confirm("Are you sure you want to update this record?");
    }

    function populateForm(dependencyID, dependentTaskID, prerequisiteTaskID) {
      document.getElementById('DependencyID').value = dependencyID;
      document.getElementById('DependentTaskID').value = dependentTaskID;
      document.getElementById('PrerequisiteTaskID').value = prerequisiteTaskID;
      document.getElementsByName('add')[0].style.display = 'none';
      document.getElementsByName('update')[0].style.display = 'inline';
    }
  </script>
</head>

<body>

<header>
  <ul>
    <li><img src="./logo.jpg" width="90" height="60" alt="Logo"></li>
    <li><a href="./assignments.php" class="button">Assignments</a></li>
    <li><a href="./comments.php" class="button">Comments</a></li>
    <li><a href="./attachments.php" class="button">Attachments</a></li>
    <li><a href="./tasks.php" class="button">Tasks</a></li>
    <li><a href="./taskdependencies.php" class="button">TasksDependencies</a></li>
    <li><a href="./taskhistory.php" class="button">TasksHistory</a></li>
    <li><a href="./notifications.php" class="button">Notifications</a></li>
    <li><a href="./users.php" class="button">Users</a></li>
    <li><a href="./tags.php" class="button">Tags</a></li>
    <li><a href="./projects.php" class="button">Projects</a></li>
    <li><a href="logout.php" class="button" style="color: darkgreen; background-color: skyblue; padding: 10px; text-decoration: none; margin-right: 15px;">Logout</a></li>
  </ul>
</header>

<section>
  <h1>TaskDependencies Form</h1>

  <form id="TaskDependenciesForm" method="post">
    <label for="DependentTaskID">DependentTaskID:</label>
    <input type="number" id="DependentTaskID" name="DependentTaskID" required><br><br>

    <label for="PrerequisiteTaskID">PrerequisiteTaskID:</label>
    <input type="number" id="PrerequisiteTaskID" name="PrerequisiteTaskID" required><br><br>
   
    <input type="submit" name="add" value="Insert" onclick="return confirmInsertion();" class="button">
    <input type="hidden" id="DependencyID" name="DependencyID">
    <input type="submit" name="update" value="Update" onclick="return confirmUpdate();" class="button">
  </form>

  <h2>Table of TaskDependencies</h2>
  <table border="1">
    <tr>
      <th>DependencyID</th>
      <th>DependentTaskID</th>
      <th>PrerequisiteTaskID</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    // Fetch data from taskdependencies table
    $sql = "SELECT * FROM taskdependencies";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $DependencyID = $row['DependencyID'];
            $DependentTaskID = $row['DependentTaskID'];
            $PrerequisiteTaskID = $row['PrerequisiteTaskID'];
            echo "<tr>
                    <td>" . $DependencyID . "</td>
                    <td>" . $DependentTaskID . "</td>
                    <td>" . $PrerequisiteTaskID . "</td>
                    <td><a href='?delete=true&DependencyID=$DependencyID' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td> 
                    <td><a href='#' onclick='populateForm($DependencyID, $DependentTaskID, $PrerequisiteTaskID);'>Update</a></td> 
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No data found</td></tr>";
    }

    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>

  <!-- Back to Dashboard Link -->
<a class="back-to-dashboard" href="admindashboard.php">Back to Dashboard</a>
  <!-- Footer content -->
  <!-- Include your footer content here -->
</footer>

</body>
</html>
