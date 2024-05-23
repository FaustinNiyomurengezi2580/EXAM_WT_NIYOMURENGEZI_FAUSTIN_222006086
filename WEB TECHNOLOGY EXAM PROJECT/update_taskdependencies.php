<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TaskDependencies Page</title>
  <style>
    /* CSS styles */
    /* Define your styles here */
  </style>
</head>

<body style="background-image: url('./Images/LECTA.jpg');background-repeat: no-repeat;background-size:cover;">

<header>
  <ul>
    <li>
      <img src="./logo.jpg" width="90" height="60" alt="Logo">
    </li>
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
    <li><a href="logout.php" style="padding: 10px; color: darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Logout</a></li>
  </ul>
    <br><br>
  </ul>
</header>

<section>
  <!-- TaskDependencies Form -->
  <h1>TaskDependencies Form</h1>

  <form id="TaskDependenciesForm" method="post" action="">
    <input type="hidden" id="DependencyID" name="DependencyID">
    <label for="DependentTaskID">DependentTaskID:</label>
    <input type="number" id="DependentTaskID" name="DependentTaskID" required><br><br>

    <label for="PrerequisiteTaskID">PrerequisiteTaskID:</label>
    <input type="number" id="PrerequisiteTaskID" name="PrerequisiteTaskID" required><br><br>
   
    <input type="submit" name="add" value="Insert" onclick="return confirmInsertion();">
    <input type="submit" name="update" value="Update" onclick="return confirmUpdate();">
  </form>

  <!-- JavaScript code for form submission confirmation -->
  <script>
    function confirmInsertion() {
      return confirm("Are you sure you want to insert this record?");
    }
    function confirmUpdate() {
      return confirm("Are you sure you want to update this record?");
    }
  </script>

  <!-- PHP code for form submission and displaying records -->
  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['add'])) {
          // Prepare and bind parameters with appropriate data types for insertion
          $stmt = $connection->prepare("INSERT INTO taskdependencies (DependentTaskID, PrerequisiteTaskID) VALUES (?, ?)");
          $stmt->bind_param("ii", $DependentTaskID, $PrerequisiteTaskID);

          // Set parameters from POST data with validation (optional)
          $DependentTaskID = intval($_POST['DependentTaskID']); // Ensure integer for DependentTaskID
          $PrerequisiteTaskID = intval($_POST['PrerequisiteTaskID']); // Ensure integer for PrerequisiteTaskID

          // Execute prepared statement with error handling
          if ($stmt->execute()) {
              echo "New record has been added successfully!";
          } else {
              echo "Error: " . $stmt->error;
          }

          $stmt->close();
      }

      if (isset($_POST['update'])) {
          // Prepare and bind parameters with appropriate data types for updating
          $stmt = $connection->prepare("UPDATE taskdependencies SET DependentTaskID = ?, PrerequisiteTaskID = ? WHERE DependencyID = ?");
          $stmt->bind_param("iii", $DependentTaskID, $PrerequisiteTaskID, $DependencyID);

          // Set parameters from POST data with validation (optional)
          $DependencyID = intval($_POST['DependencyID']);
          $DependentTaskID = intval($_POST['DependentTaskID']);
          $PrerequisiteTaskID = intval($_POST['PrerequisiteTaskID']);

          // Execute prepared statement with error handling
          if ($stmt->execute()) {
              echo "Record has been updated successfully!";
          } else {
              echo "Error: " . $stmt->error;
          }

          $stmt->close();
      }
  }

  if (isset($_GET['delete'])) {
      // Prepare and bind parameters with appropriate data types for deletion
      $stmt = $connection->prepare("DELETE FROM taskdependencies WHERE DependencyID = ?");
      $stmt->bind_param("i", $DependencyID);

      // Set parameter from GET data with validation (optional)
      $DependencyID = intval($_GET['DependencyID']);

      // Execute prepared statement with error handling
      if ($stmt->execute()) {
          echo "Record has been deleted successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  $connection->close();
  ?>

  <!-- Table to display task dependencies records -->
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
    include('database_connection.php');

    // SQL query to fetch data from taskdependencies table
    $sql = "SELECT * FROM taskdependencies";
    $result = $connection->query($sql);

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $DependencyID = $row['DependencyID']; 
            echo "<tr>
                    <td>" . $row['DependencyID'] . "</td>
                    <td>" . $row['DependentTaskID'] . "</td>
                    <td>" . $row['PrerequisiteTaskID'] . "</td>
                    <td><a style='padding:4px' href='?delete=true&DependencyID=$DependencyID'>Delete</a></td> 
                    <td><a style='padding:4px' href='?update=true&DependencyID=$DependencyID&DependentTaskID=" . $row['DependentTaskID'] . "&PrerequisiteTaskID=" . $row['PrerequisiteTaskID'] . "'>Update</a></td> 
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
  <!-- Footer content -->
  <!-- Include your footer content here -->
</footer>

</body>
</html>
