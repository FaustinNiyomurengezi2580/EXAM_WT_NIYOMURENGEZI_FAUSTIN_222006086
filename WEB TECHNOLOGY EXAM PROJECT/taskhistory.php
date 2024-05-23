<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Task History Management</title>
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

/* Specific styling for all forms */
form {
  background-color: yellow; /* Add yellow background color */
  padding: 20px;
  border-radius: 10px;
}

form label {
  display: block;
  margin-top: 10px;
}

form input[type="number"],
form input[type="text"],
form textarea {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form input[type="date"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form input[type="submit"] {
  margin-top: 20px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: darkgreen;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s;
}

form input[type="submit"]:hover {
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
  <h1>Task History Management</h1>

  <!-- Insert Form -->
  <h2>Insert Task History</h2>
  <form method="post" action="">
    <label for="TaskID">TaskID:</label>
    <input type="number" id="TaskID" name="TaskID" required><br><br>

    <label for="UserID">UserID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="OldValue">Old Value:</label>
    <input type="text" id="OldValue" name="OldValue"><br><br>

    <label for="NewValue">New Value:</label>
    <input type="text" id="NewValue" name="NewValue"><br><br>

    <label for="ChangeDescription">Change Description:</label>
    <textarea id="ChangeDescription" name="ChangeDescription" required></textarea><br><br>

    <input type="submit" name="add" value="Insert" onclick="return confirm('Are you sure you want to insert this record?');">
  </form>

  <?php
  include('database_connection.php');

  // Insert new record
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $TaskID = intval($_POST['TaskID']);
      $UserID = intval($_POST['UserID']);
      $OldValue = htmlspecialchars($_POST['OldValue']);
      $NewValue = htmlspecialchars($_POST['NewValue']);
      $ChangeDescription = htmlspecialchars($_POST['ChangeDescription']);

      $stmt = $connection->prepare("INSERT INTO taskhistory (TaskID, UserID, OldValue, NewValue, ChangeDescription) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("iisss", $TaskID, $UserID, $OldValue, $NewValue, $ChangeDescription);

      if ($stmt->execute()) {
          echo "New record has been added successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  // Delete record
  if (isset($_GET['delete'])) {
      $HistoryID = intval($_GET['delete']);
      $stmt = $connection->prepare("DELETE FROM taskhistory WHERE HistoryID = ?");
      $stmt->bind_param("i", $HistoryID);

      if ($stmt->execute()) {
          echo "Record deleted successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  // Fetch all records to display
  $sql = "SELECT * FROM taskhistory";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      echo "<h2>Table of Task History</h2>";
      echo "<table border='1'>";
      echo "<tr><th>HistoryID</th><th>TaskID</th><th>UserID</th><th>Timestamp</th><th>OldValue</th><th>NewValue</th><th>ChangeDescription</th><th>Delete</th><th>Update</th></tr>";
      while ($row = $result->fetch_assoc()) {
          $HistoryID = $row['HistoryID'];
          echo "<tr>
                <td>" . $row['HistoryID'] . "</td>
                <td>" . $row['TaskID'] . "</td>
                <td>" . $row['UserID'] . "</td>
                <td>" . $row['Timestamp'] . "</td>
                <td>" . $row['OldValue'] . "</td>
                <td>" . $row['NewValue'] . "</td>
                <td>" . $row['ChangeDescription'] . "</td>
                <td><a style='padding:4px' href='update_taskhistory.php?delete=$HistoryID'>Delete</a></td>
                <td><a style='padding:4px' href='update_taskhistory.php?HistoryID=$HistoryID'>Update</a></td>
              </tr>";
      }
      echo "</table>";
  } else {
      echo "<p>No data found</p>";
  }

  // Fetch record for update
  if (isset($_GET['HistoryID'])) {
      $HistoryID = intval($_GET['HistoryID']);
      $result = $connection->query("SELECT * FROM taskhistory WHERE HistoryID = $HistoryID");

      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          ?>
          <!-- Update Form -->
          <h2>Update Task History</h2>
          <form method="post" action="">
            <input type="hidden" name="HistoryID" value="<?php echo $row['HistoryID']; ?>">
            <label for="TaskID">TaskID:</label>
            <input type="number" id="TaskID" name="TaskID" value="<?php echo $row['TaskID']; ?>" required><br><br>

            <label for="UserID">UserID:</label>
            <input type="number" id="UserID" name="UserID" value="<?php echo $row['UserID']; ?>" required><br><br>

            <label for="OldValue">Old Value:</label>
            <input type="text" id="OldValue" name="OldValue" value="<?php echo $row['OldValue']; ?>"><br><br>

            <label for="NewValue">New Value:</label>
            <input type="text" id="NewValue" name="NewValue" value="<?php echo $row['NewValue']; ?>"><br><br>

            <label for="ChangeDescription">Change Description:</label>
            <textarea id="ChangeDescription" name="ChangeDescription" required><?php echo $row['ChangeDescription']; ?></textarea><br><br>

            <input type="submit" name="update" value="Update">
          </form>
          <?php
      } else {
          echo "No record found!";
      }
  }

  // Update record
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
      $HistoryID = intval($_POST['HistoryID']);
      $TaskID = intval($_POST['TaskID']);
      $UserID = intval($_POST['UserID']);
      $OldValue = htmlspecialchars($_POST['OldValue']);
      $NewValue = htmlspecialchars($_POST['NewValue']);
      $ChangeDescription = htmlspecialchars($_POST['ChangeDescription']);

      $stmt = $connection->prepare("UPDATE taskhistory SET TaskID=?, UserID=?, OldValue=?, NewValue=?, ChangeDescription=? WHERE HistoryID=?");
      $stmt->bind_param("iisssi", $TaskID, $UserID, $OldValue, $NewValue, $ChangeDescription, $HistoryID);

      if ($stmt->execute()) {
          echo "Record updated successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  $connection->close();
  ?>

</section>
<footer>

  <!-- Back to Dashboard Link -->
<a class="back-to-dashboard" href="admindashboard.php">Back to Dashboard</a>
  <!-- Footer content -->
</footer>

</body>
</html>
