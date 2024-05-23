<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Comments Page</title>
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
    form#commentsForm {
      background-color: yellow;
      padding: 20px;
      border-radius: 10px;
    }
    form#commentsForm label {
      display: block;
      margin-top: 10px;
    }
    form#commentsForm input[type="number"],
    form#commentsForm input[type="datetime-local"],
    form#commentsForm textarea {
      width: calc(100% - 22px);
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    form#commentsForm input[type="submit"] {
      margin-top: 20px;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: darkgreen;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    form#commentsForm input[type="submit"]:hover {
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
</head>

<body>
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
</header>

<section>
  <!-- Comments Form -->
  <h1>Comments Form</h1>

  <?php
  // Include database connection
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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind parameters with appropriate data types
      $stmt = $connection->prepare("INSERT INTO comments (CommentID, TaskID, ProjectID, UserID, Timestamp, Content) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiiis", $CommentID, $TaskID, $ProjectID, $UserID, $Timestamp, $Content);

      // Set parameters from POST data with validation (optional)
      $CommentID = intval($_POST['CommentID']); // Ensure integer for CommentID
      $TaskID = intval($_POST['TaskID']); // Ensure integer for TaskID
      $ProjectID = intval($_POST['ProjectID']); // Ensure integer for ProjectID
      $UserID = intval($_POST['UserID']); // Ensure integer for UserID
      $Timestamp = $_POST['Timestamp']; // Assume it's a valid datetime string
      $Content = htmlspecialchars($_POST['Content']); // Prevent XSS

      // Execute prepared statement with error handling
      if ($stmt->execute()) {
          echo "New record has been added successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  ?>

  <form id="commentsForm" method="post" action="">
    <label for="CommentID">CommentID:</label>
    <input type="number" id="CommentID" name="CommentID" required><br><br>

    <label for="TaskID">TaskID:</label>
    <input type="number" id="TaskID" name="TaskID" required><br><br>

    <label for="ProjectID">ProjectID:</label>
    <input type="number" id="ProjectID" name="ProjectID" required><br><br>

    <label for="UserID">UserID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="Timestamp">Timestamp:</label>
    <input type="datetime-local" id="Timestamp" name="Timestamp" required><br><br>

    <label for="Content">Content:</label>
    <textarea id="Content" name="Content" required></textarea><br><br>

    <input type="submit" value="Insert" onclick="return confirmInsertion();">
  </form>

  <!-- JavaScript code for form submission confirmation -->
  <script>
    function confirmInsertion() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>

  <!-- Table to display comments records -->
  <h2>Table of Comments</h2>
  <table border="1">
    <tr>
      <th>CommentID</th>
      <th>TaskID</th>
      <th>ProjectID</th>
      <th>UserID</th>
      <th>Timestamp</th>
      <th>Content</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    // SQL query to fetch data from comments table
    $sql = "SELECT * FROM comments";
    $result = $connection->query($sql);

    // Check if there are any comments records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $comment_id = $row['CommentID'];
            echo "<tr>
                    <td>" . $row['CommentID'] . "</td>
                    <td>" . $row['TaskID'] . "</td>
                    <td>" . $row['ProjectID'] . "</td>
                    <td>" . $row['UserID'] . "</td>
                    <td>" . $row['Timestamp'] . "</td>
                    <td>" . $row['Content'] . "</td>
                    <td><a style='padding:4px' href='delete_comments.php?CommentID=$comment_id'>Delete</a></td>
                    <td><a style='padding:4px' href='update_comments.php?CommentID=$comment_id'>Update</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <!-- Footer content -->
  <p>&copy; 2024 Comments Page. All Rights Reserved.</p>
</footer>

<!-- Back to Dashboard Link -->
<a class="back-to-dashboard" href="admindashboard.php">Back to Dashboard</a>

</body>
</html>
