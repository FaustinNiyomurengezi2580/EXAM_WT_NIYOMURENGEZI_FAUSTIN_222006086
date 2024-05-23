<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Task History</title>
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
  <h1>Update Task History</h1>

  <?php
  include('database_connection.php');

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
  } else if (isset($_GET['HistoryID'])) {
      $HistoryID = intval($_GET['HistoryID']);
      $result = $connection->query("SELECT * FROM taskhistory WHERE HistoryID = $HistoryID");

      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          ?>
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
  } else {
      echo "No HistoryID specified!";
  }

  $connection->close();
  ?>
</section>

<footer>
  <!-- Footer content -->
</footer>

</body>
</html>
