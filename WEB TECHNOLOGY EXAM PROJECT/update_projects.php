<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Project</title>
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
  <!-- Project Form -->
  <h1>Update Project</h1>

  <?php
  // Include database connection
  include('database_connection.php');

  // Initialize variables
  $ProjectID = 0;
  $Title = '';
  $Description = '';
  $StartDate = '';
  $EndDate = '';

  // Check if ProjectID is set in URL
  if (isset($_GET['ProjectID'])) {
    $ProjectID = intval($_GET['ProjectID']);

    // Fetch project details based on ProjectID
    $sql = "SELECT * FROM projects WHERE ProjectID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ProjectID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $project = $result->fetch_assoc();
      $Title = $project['Title'];
      $Description = $project['Description'];
      $StartDate = $project['StartDate'];
      $EndDate = $project['EndDate'];
    } else {
      echo "No project found with the provided ProjectID.";
    }

    $stmt->close();
  }

  // Handle form submission for updating project
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ProjectID = intval($_POST['ProjectID']);
    $Title = htmlspecialchars($_POST['Title']);
    $Description = htmlspecialchars($_POST['Description']);
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];

    // Update project record
    $sql = "UPDATE projects SET Title = ?, Description = ?, StartDate = ?, EndDate = ? WHERE ProjectID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $Title, $Description, $StartDate, $EndDate, $ProjectID);

    if ($stmt->execute()) {
      echo "Project updated successfully!";
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }

  $connection->close();
  ?>

  <form id="projectForm" method="post" action="">
    <input type="hidden" id="ProjectID" name="ProjectID" value="<?php echo $ProjectID; ?>">

    <label for="Title">Title:</label>
    <input type="text" id="Title" name="Title" value="<?php echo $Title; ?>" required><br><br>

    <label for="Description">Description:</label>
    <input type="text" id="Description" name="Description" value="<?php echo $Description; ?>" required><br><br>

    <label for="StartDate">StartDate:</label>
    <input type="date" id="StartDate" name="StartDate" value="<?php echo $StartDate; ?>" required><br><br>

    <label for="EndDate">EndDate:</label>
    <input type="date" id="EndDate" name="EndDate" value="<?php echo $EndDate; ?>" required><br><br>

    <input type="submit" value="Update" onclick="return confirm('Are you sure you want to update this record?');">
  </form>
</section>

<footer>
  <!-- Footer content -->
  <!-- Include your footer content here -->
</footer>

</body>
</html>
