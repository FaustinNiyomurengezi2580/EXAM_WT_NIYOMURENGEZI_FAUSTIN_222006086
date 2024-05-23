<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tasks Page</title>
  <style>
    /* CSS styles */
    body {
      background-image: url('./Images/LECTA.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }

    header ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      background-color: #f1f1f1;
    }

    header li {
      display: inline;
      margin-right: 10px;
    }

    header a {
      padding: 10px 15px;
      color: white;
      background-color: green;
      text-decoration: none;
      border-radius: 5px;
    }

    header a:hover {
      background-color: darkgreen;
    }

    form label {
      display: inline-block;
      width: 100px;
      margin-bottom: 10px;
    }

    form input[type="text"],
    form input[type="number"],
    form input[type="date"] {
      width: 200px;
      padding: 5px;
      margin-bottom: 10px;
    }

    form input[type="submit"] {
      padding: 10px 15px;
      background-color: green;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    form input[type="submit"]:hover {
      background-color: darkgreen;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: lightgrey;
    }

    td a {
      padding: 4px 8px;
      background-color: green;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    td a:hover {
      background-color: darkgreen;
    }
  </style>
</head>

<body>

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
    <li><a href="logout.php" style="background-color: skyblue; color: darkgreen;">Logout</a></li>
  </ul>
</header>

<section>
  <!-- Tasks Form -->
  <h1>Tasks Form</h1>

  <form id="taskForm" method="post">
    <label for="TaskID">TaskID:</label>
    <input type="number" id="TaskID" name="TaskID"><br><br>

    <label for="Title">Title:</label>
    <input type="text" id="Title" name="Title" required><br><br>

    <label for="Description">Description:</label>
    <input type="text" id="Description" name="Description" required><br><br>

    <label for="DueDate">DueDate:</label>
    <input type="date" id="DueDate" name="DueDate" required><br><br>

    <label for="Priority">Priority:</label>
    <input type="number" id="Priority" name="Priority" required><br><br>

    <label for="Status">Status:</label>
    <input type="text" id="Status" name="Status" required><br><br>

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

  <!-- PHP code for form submission and displaying records -->
  <?php
  // PHP code for form submission and displaying records
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind parameters with appropriate data types
      $stmt = $connection->prepare("INSERT INTO tasks (TaskID, Title, Description, DueDate, Priority, Status, AssignedUserID) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isssisi", $TaskID, $Title, $Description, $DueDate, $Priority, $Status, $AssignedUserID);

      // Set parameters from POST data with validation (optional)
      $TaskID = intval($_POST['TaskID']); // Ensure integer for TaskID
      $Title = htmlspecialchars($_POST['Title']); // Prevent XSS
      $Description = htmlspecialchars($_POST['Description']); // Prevent XSS
      $DueDate = $_POST['DueDate']; // Use date input as-is
      $Priority = intval($_POST['Priority']); // Ensure integer for Priority
      $Status = htmlspecialchars($_POST['Status']); // Prevent XSS
      $AssignedUserID = intval($_POST['AssignedUserID']); // Ensure integer for AssignedUserID

      // Execute prepared statement with error handling
      if ($stmt->execute()) {
          echo "New record has been added successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  $connection->close();
  ?>

  <!-- Table to display tasks records -->
  <h2>Table of Tasks</h2>
  <table border="1">
    <tr>
      <th>TaskID</th>
      <th>Title</th>
      <th>Description</th>
      <th>DueDate</th>
      <th>Priority</th>
      <th>Status</th>
      <th>AssignedUserID</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from tasks table
    $sql = "SELECT * FROM tasks";
    $result = $connection->query($sql);

    // Check if there are any tasks records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $task_id = $row['TaskID']; // Fetch the TaskID
            echo "<tr>
                    <td>" . $row['TaskID'] . "</td>
                    <td>" . $row['Title'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['DueDate'] . "</td>
                    <td>" . $row['Priority'] . "</td>
                    <td>" . $row['Status'] . "</td>
                    <td>" . $row['AssignedUserID'] . "</td>
                    <td><a href='delete_task.php?TaskID=$task_id'>Delete</a></td>
                    <td><a href='update_task.php?TaskID=$task_id'>Update</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
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
