<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Notification</title>
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
  <h1>Update Notification Form</h1>

  <?php
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "task_management_application";

  $connection = new mysqli($servername, $username, $password, $dbname);

  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }

  if (isset($_GET['NotificationID'])) {
      $NotificationID = $_GET['NotificationID'];
      $sql = "SELECT * FROM notifications WHERE NotificationID = ?";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param("i", $NotificationID);
      $stmt->execute();
      $result = $stmt->get_result();
      $notification = $result->fetch_assoc();

      if ($notification) {
  ?>

  <form id="updateNotificationForm" method="post" action="">
    <input type="hidden" name="NotificationID" value="<?php echo $notification['NotificationID']; ?>">
    <label for="RecipientUserID">RecipientUserID:</label>
    <input type="number" id="RecipientUserID" name="RecipientUserID" value="<?php echo $notification['RecipientUserID']; ?>" required><br><br>

    <label for="SenderUserID">SenderUserID:</label>
    <input type="number" id="SenderUserID" name="SenderUserID" value="<?php echo $notification['SenderUserID']; ?>" required><br><br>

    <label for="NotificationType">NotificationType:</label>
    <input type="text" id="NotificationType" name="NotificationType" value="<?php echo $notification['NotificationType']; ?>" required><br><br>

    <label for="Content">Content:</label>
    <textarea id="Content" name="Content" required><?php echo $notification['Content']; ?></textarea><br><br>

    <input type="submit" name="update" value="Update" onclick="return confirmUpdate();">
  </form>

  <?php
      } else {
          echo "No notification found with ID " . $NotificationID;
      }
      $stmt->close();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
      $NotificationID = $_POST['NotificationID'];
      $RecipientUserID = intval($_POST['RecipientUserID']);
      $SenderUserID = intval($_POST['SenderUserID']);
      $NotificationType = htmlspecialchars($_POST['NotificationType']);
      $Content = htmlspecialchars($_POST['Content']);

      $stmt = $connection->prepare("UPDATE notifications SET RecipientUserID = ?, SenderUserID = ?, NotificationType = ?, Content = ? WHERE NotificationID = ?");
      $stmt->bind_param("iissi", $RecipientUserID, $SenderUserID, $NotificationType, $Content, $NotificationID);

      if ($stmt->execute()) {
          echo "Record updated successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  $connection->close();
  ?>

  <script>
    function confirmUpdate() {
      return confirm("Are you sure you want to update this record?");
    }
  </script>
</section>

</body>
</html>
