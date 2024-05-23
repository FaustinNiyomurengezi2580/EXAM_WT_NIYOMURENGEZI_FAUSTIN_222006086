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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Attachment</title>
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
  <h1>Update Attachment</h1>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
      $AttachmentID = intval($_POST['AttachmentID']);
      $TaskID = intval($_POST['TaskID']);
      $ProjectID = intval($_POST['ProjectID']);
      $UserID = intval($_POST['UserID']);
      $FileName = htmlspecialchars($_POST['FileName']);
      $FileType = htmlspecialchars($_POST['FileType']);
      $FileLocation = htmlspecialchars($_POST['FileLocation']);

      $stmt = $connection->prepare("UPDATE attachments SET TaskID=?, ProjectID=?, UserID=?, FileName=?, FileType=?, FileLocation=? WHERE AttachmentID=?");
      $stmt->bind_param("iiisssi", $TaskID, $ProjectID, $UserID, $FileName, $FileType, $FileLocation, $AttachmentID);

      if ($stmt->execute()) {
          echo "Record updated successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  } else {
      if (isset($_GET['AttachmentID'])) {
          $AttachmentID = intval($_GET['AttachmentID']);
          $result = $connection->query("SELECT * FROM attachments WHERE AttachmentID = $AttachmentID");

          if ($result->num_rows == 1) {
              $row = $result->fetch_assoc();
              ?>
              <form method="post" action="">
                <input type="hidden" name="AttachmentID" value="<?php echo $row['AttachmentID']; ?>">
                <label for="TaskID">TaskID:</label>
                <input type="number" id="TaskID" name="TaskID" value="<?php echo $row['TaskID']; ?>" required><br><br>

                <label for="ProjectID">ProjectID:</label>
                <input type="number" id="ProjectID" name="ProjectID" value="<?php echo $row['ProjectID']; ?>" required><br><br>

                <label for="UserID">UserID:</label>
                <input type="number" id="UserID" name="UserID" value="<?php echo $row['UserID']; ?>" required><br><br>

                <label for="FileName">FileName:</label>
                <input type="text" id="FileName" name="FileName" value="<?php echo $row['FileName']; ?>" required><br><br>

                <label for="FileType">FileType:</label>
                <input type="text" id="FileType" name="FileType" value="<?php echo $row['FileType']; ?>" required><br><br>

                <label for="FileLocation">FileLocation:</label>
                <input type="text" id="FileLocation" name="FileLocation" value="<?php echo $row['FileLocation']; ?>" required><br><br>

                <input type="submit" name="update" value="Update">
              </form>
              <?php
          } else {
              echo "No record found!";
          }
      } else {
          echo "No AttachmentID provided!";
      }
  }

  $connection->close();
  ?>
</section>

<footer>
  <!-- Footer content -->
</footer>

</body>
</html>
