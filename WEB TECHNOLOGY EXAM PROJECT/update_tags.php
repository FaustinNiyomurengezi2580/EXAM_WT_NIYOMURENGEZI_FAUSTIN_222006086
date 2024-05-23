<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tag Page</title>
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
  <!-- Tag Form -->
  <h1>Tag Form</h1>

  <form id="TagForm" method="post">
    <label for="TagName">TagName:</label>
    <input type="text" id="TagName" name="TagName" required><br><br>
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
      $stmt = $connection->prepare("INSERT INTO tags (TagName) VALUES (?)");
      $stmt->bind_param("s", $TagName);

      // Set parameters from POST data with validation (optional)
      $TagName = htmlspecialchars($_POST['TagName']); // Prevent XSS

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

  <!-- Table to display tag records -->
  <h2>Table of Tags</h2>
  <table border="1">
    <tr>
      <th>TagID</th>
      <th>TagName</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from tags table
    $sql = "SELECT * FROM tags";
    $result = $connection->query($sql);

    // Check if there are any TagID records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $TagID = $row['TagID']; // Fetch the TagID
            echo "<tr>
                    <td>" . $row['TagID'] . "</td>
                    <td>" . $row['TagName'] . "</td>
                    <td><a style='padding:4px' href='delete_tags.php?TagID=$TagID'>Delete</a></td> 
                    <td><a style='padding:4px' href='tags.php?TagID=$TagID'>Update</a></td> 
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
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
