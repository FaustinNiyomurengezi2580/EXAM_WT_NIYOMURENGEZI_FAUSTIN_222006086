<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notification Page</title>
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
    form#notificationForm {
      background-color: yellow;
      padding: 20px;
      border-radius: 10px;
    }
    form#notificationForm label {
      display: block;
      margin-top: 10px;
    }
    form#notificationForm input[type="number"],
    form#notificationForm input[type="text"],
    form#notificationForm textarea {
      width: calc(100% - 22px);
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    form#notificationForm input[type="submit"] {
      margin-top: 20px;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: darkgreen;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    form#notificationForm input[type="submit"]:hover {
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
    <li><a href="logout.php" style="padding: 10px; color: darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Logout</a></li>
  </ul>
</header>

<section>
  <h1>Notification Form</h1>

  <?php
  // Database connection script
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "task_management_application";

  // Create connection
  $connection = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }

  // Handle form submission for adding or updating notification
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['add'])) {
          // Insert new notification
          $stmt = $connection->prepare("INSERT INTO notifications (RecipientUserID, SenderUserID, NotificationType, Content) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("iiss", $RecipientUserID, $SenderUserID, $NotificationType, $Content);

          $RecipientUserID = intval($_POST['RecipientUserID']);
          $SenderUserID = intval($_POST['SenderUserID']);
          $NotificationType = htmlspecialchars($_POST['NotificationType']);
          $Content = htmlspecialchars($_POST['Content']);

          if ($stmt->execute()) {
              echo "<script>alert('New record has been added successfully!');</script>";
          } else {
              echo "Error: " . $stmt->error;
          }

          $stmt->close();
      } elseif (isset($_POST['update'])) {
          // Update existing notification
          $stmt = $connection->prepare("UPDATE notifications SET RecipientUserID = ?, SenderUserID = ?, NotificationType = ?, Content = ? WHERE NotificationID = ?");
          $stmt->bind_param("iissi", $RecipientUserID, $SenderUserID, $NotificationType, $Content, $NotificationID);

          $NotificationID = intval($_POST['NotificationID']);
          $RecipientUserID = intval($_POST['RecipientUserID']);
          $SenderUserID = intval($_POST['SenderUserID']);
          $NotificationType = htmlspecialchars($_POST['NotificationType']);
          $Content = htmlspecialchars($_POST['Content']);

          if ($stmt->execute()) {
              echo "<script>alert('Record updated successfully!');</script>";
          } else {
              echo "Error: " . $stmt->error;
          }

          $stmt->close();
      }
  }

  // Handle deletion of notification
  if (isset($_GET['delete'])) {
      $NotificationID = intval($_GET['delete']);
      $stmt = $connection->prepare("DELETE FROM notifications WHERE NotificationID = ?");
      $stmt->bind_param("i", $NotificationID);

      if ($stmt->execute()) {
          echo "<script>alert('Record deleted successfully!');</script>";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  // Fetch notification details if updating
  if (isset($_GET['update'])) {
      $NotificationID = intval($_GET['update']);
      $sql = "SELECT * FROM notifications WHERE NotificationID = ?";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param("i", $NotificationID);
      $stmt->execute();
      $result = $stmt->get_result();
      $notification = $result->fetch_assoc();
      $stmt->close();
  }
  ?>

  <!-- Notification form -->
  <form id="notificationForm" method="post" action="">
    <?php if (isset($notification)): ?>
      <input type="hidden" name="NotificationID" value="<?php echo $notification['NotificationID']; ?>">
    <?php endif; ?>
    <label for="RecipientUserID">RecipientUserID:</label>
    <input type="number" id="RecipientUserID" name="RecipientUserID" value="<?php echo $notification['RecipientUserID'] ?? ''; ?>" required><br><br>

    <label for="SenderUserID">SenderUserID:</label>
    <input type="number" id="SenderUserID" name="SenderUserID" value="<?php echo $notification['SenderUserID'] ?? ''; ?>" required><br><br>

    <label for="NotificationType">NotificationType:</label>
    <input type="text" id="NotificationType" name="NotificationType" value="<?php echo $notification['NotificationType'] ?? ''; ?>" required><br><br>

    <label for="Content">Content:</label>
    <textarea id="Content" name="Content" required><?php echo $notification['Content'] ?? ''; ?></textarea><br><br>

    <input type="submit" name="<?php echo isset($notification) ? 'update' : 'add'; ?>" value="<?php echo isset($notification) ? 'Update' : 'Insert'; ?>" onclick="return confirm('<?php echo isset($notification) ? 'Are you sure you want to update this record?' : 'Are you sure you want to insert this record?'; ?>');">
  </form>
</section>

<section>
  <h2>Table of Notifications</h2>
  <table>
    <tr>
      <th>NotificationID</th>
      <th>RecipientUserID</th>
      <th>SenderUserID</th>
      <th>Timestamp</th>
      <th>NotificationType</th>
      <th>Content</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    $sql = "SELECT * FROM notifications";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $NotificationID = $row['NotificationID'];
            echo "<tr>
                    <td>" . $row['NotificationID'] . "</td>
                    <td>" . $row['RecipientUserID'] . "</td>
                    <td>" . $row['SenderUserID'] . "</td>
                    <td>" . $row['Timestamp'] . "</td>
                    <td>" . $row['NotificationType'] . "</td>
                    <td>" . $row['Content'] . "</td>
                    <td><a style='padding:4px' href='?delete=$NotificationID' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>
                    <td><a style='padding:4px' href='?update=$NotificationID'>Update</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No data found</td></tr>";
    }
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
