<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TaskHistory Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
  <h1>Attachments Form</h1>

  <form id="attachmentForm" method="post">
    <label for="TaskID">TaskID:</label>
    <input type="number" id="TaskID" name="TaskID"><br><br>

    <label for="ProjectID">ProjectID:</label>
    <input type="number" id="ProjectID" name="ProjectID" required><br><br>

    <label for="UserID">UserID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="FileName">FileName:</label>
    <input type="text" id="FileName" name="FileName" required><br><br>

    <label for="FileType">FileType:</label>
    <input type="text" id="FileType" name="FileType" required><br><br>

    <label for="FileLocation">FileLocation:</label>
    <input type="text" id="FileLocation" name="FileLocation" required><br><br>

    <input type="submit" name="add" value="Insert" onclick="return confirmInsertion();">
  </form>

  <script>
    function confirmInsertion() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $stmt = $connection->prepare("INSERT INTO attachments (TaskID, ProjectID, UserID, FileName, FileType, FileLocation) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiisss", $TaskID, $ProjectID, $UserID, $FileName, $FileType, $FileLocation);

      $TaskID = intval($_POST['TaskID']);
      $ProjectID = intval($_POST['ProjectID']);
      $UserID = intval($_POST['UserID']);
      $FileName = htmlspecialchars($_POST['FileName']);
      $FileType = htmlspecialchars($_POST['FileType']);
      $FileLocation = htmlspecialchars($_POST['FileLocation']);

      if ($stmt->execute()) {
          echo "New record has been added successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  if (isset($_GET['delete'])) {
    $AttachmentID = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM attachments WHERE AttachmentID = ?");
    $stmt->bind_param("i", $AttachmentID);

    if ($stmt->execute()) {
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }

  $sql = "SELECT * FROM attachments";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      echo "<h2>Table of Attachments</h2>";
      echo "<table>";
      echo "<tr><th>AttachmentID</th><th>TaskID</th><th>ProjectID</th><th>UserID</th><th>Timestamp</th><th>FileName</th><th>FileType</th><th>FileLocation</th><th>Delete</th><th>Update</th></tr>";
      while ($row = $result->fetch_assoc()) {
          $AttachmentID = $row['AttachmentID'];
          echo "<tr>
                <td>" . $row['AttachmentID'] . "</td>
                <td>" . $row['TaskID'] . "</td>
                <td>" . $row['ProjectID'] . "</td>
                <td>" . $row['UserID'] . "</td>
                <td>" . $row['Timestamp'] . "</td>
                <td>" . $row['FileName'] . "</td>
                <td>" . $row['FileType'] . "</td>
                <td>" . $row['FileLocation'] . "</td>
                <td><a style='padding:4px' href='?delete=$AttachmentID'>Delete</a></td>
                <td><a style='padding:4px' href='update_attachments.php?AttachmentID=$AttachmentID'>Update</a></td>
              </tr>";
      }
      echo "</table>";
  } else {
      echo "<p>No data found</p>";
  }

  $connection->close();
  ?>

</section>

<footer>
  <!-- Footer content -->
  <p>&copy; 2024 TaskHistory Page. All Rights Reserved.</p>
</footer>

<!-- Back to Dashboard Link -->
<a class="back-to-dashboard" href="admindashboard.php">Back to Dashboard</a>

</body>
</html>
