<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Comment</title>
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
  <h1>Update Comment</h1>

  <?php
  include('database_connection.php');

  if (isset($_GET['CommentID'])) {
      $CommentID = intval($_GET['CommentID']);
      $result = $connection->query("SELECT * FROM comments WHERE CommentID = $CommentID");

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $TaskID = $row['TaskID'];
          $ProjectID = $row['ProjectID'];
          $UserID = $row['UserID'];
          $Content = $row['Content'];
      } else {
          echo "<p>Comment not found.</p>";
      }
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
      $CommentID = intval($_POST['CommentID']);
      $TaskID = intval($_POST['TaskID']);
      $ProjectID = intval($_POST['ProjectID']);
      $UserID = intval($_POST['UserID']);
      $Content = htmlspecialchars($_POST['Content']);

      $stmt = $connection->prepare("UPDATE comments SET TaskID = ?, ProjectID = ?, UserID = ?, Content = ? WHERE CommentID = ?");
      $stmt->bind_param("iiisi", $TaskID, $ProjectID, $UserID, $Content, $CommentID);

      if ($stmt->execute()) {
          echo "Comment updated successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>

  <form id="updateForm" method="post">
    <input type="hidden" id="CommentID" name="CommentID" value="<?php echo $CommentID; ?>" required><br><br>

    <label for="TaskID">TaskID:</label>
    <input type="number" id="TaskID" name="TaskID" value="<?php echo $TaskID; ?>" required><br><br>

    <label for="ProjectID">ProjectID:</label>
    <input type="number" id="ProjectID" name="ProjectID" value="<?php echo $ProjectID; ?>" required><br><br>

    <label for="UserID">UserID:</label>
    <input type="number" id="UserID" name="UserID" value="<?php echo $UserID; ?>" required><br><br>

    <label for="Content">Content:</label>
    <textarea id="Content" name="Content" required><?php echo $Content; ?></textarea><br><br>

    <input type="submit" name="update" value="Update">
  </form>
</section>

<footer>
  <!-- Footer content -->
</footer>

</body>
</html>
