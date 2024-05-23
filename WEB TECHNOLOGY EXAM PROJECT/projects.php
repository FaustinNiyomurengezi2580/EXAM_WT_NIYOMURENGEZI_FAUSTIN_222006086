<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Page</title>
 <style> /* CSS styles */
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

form#projectForm {
  background-color: yellow;
  padding: 20px;
  border-radius: 10px;
}

form#projectForm label {
  display: block;
  margin-top: 10px;
}

form#projectForm input[type="number"],
form#projectForm input[type="text"],
form#projectForm textarea {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#projectForm input[type="date"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#projectForm input[type="submit"] {
  margin-top: 20px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: darkgreen;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s;
}

form#projectForm input[type="submit"]:hover {
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
</style>style> 

</head>

<body style="background-image: url('./Images/LECTA.jpg');background-repeat: no-repeat;background-size:cover;">

<header>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./logo.jpg" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./assignments.php" class="button">Assignments</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./comments.php" class="button">Comments</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./attachments.php" class="button">Attachments</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./tasks.php" class="button">Tasks</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./taskdependencies.php" class="button">TasksDependencies</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./taskhistory.php" class="button">TasksHistory</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./notifications.php" class="button">Notifications</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./users.php" class="button">Users</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./tags.php" class="button">Tags</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./projects.php" class="button">Projects</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="logout.php" class="button" style="padding: 10px; color: darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Logout</a></li>
    <br><br>
  </ul>
</header>

<section>
  <!-- Project Form -->
  <h1>Project Form</h1>

  <?php
  // Include database connection
  include('database_connection.php');

  // Initialize variables
  $ProjectID = 0;
  $Title = '';
  $Description = '';
  $StartDate = '';
  $EndDate = '';
  $update = false;

  // Handle deletion of project
  if (isset($_GET['delete'])) {
    $ProjectID = intval($_GET['delete']);
    $sql = "DELETE FROM projects WHERE ProjectID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ProjectID);

    if ($stmt->execute()) {
      echo "Record deleted successfully!";
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }

  // Check if ProjectID is set in URL for update
  if (isset($_GET['edit'])) {
    $ProjectID = intval($_GET['edit']);
    $update = true;

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

  // Handle form submission for adding/updating project
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ProjectID = intval($_POST['ProjectID']);
    $Title = htmlspecialchars($_POST['Title']);
    $Description = htmlspecialchars($_POST['Description']);
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];

    if ($update) {
      // Update project record
      $sql = "UPDATE projects SET Title = ?, Description = ?, StartDate = ?, EndDate = ? WHERE ProjectID = ?";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param("ssssi", $Title, $Description, $StartDate, $EndDate, $ProjectID);
      $stmt->execute();
      $stmt->close();
      $update = false;
      echo "Project updated successfully!";
    } else {
      // Add new project record
      $stmt = $connection->prepare("INSERT INTO projects (Title, Description, StartDate, EndDate) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $Title, $Description, $StartDate, $EndDate);
      $stmt->execute();
      $stmt->close();
      echo "New record has been added successfully!";
    }
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

    <
    <label for="EndDate">EndDate:</label>
    <input type="date" id="EndDate" name="EndDate" value="<?php echo $EndDate; ?>" required><br><br>

    <input type="submit" value="<?php echo $update ? 'Update' : 'Insert'; ?>" onclick="return confirm('Are you sure you want to <?php echo $update ? 'update' : 'insert'; ?> this record?');">
  </form>

  <!-- Table to display project records -->
  <h2>Table of Projects</h2>
  <table border="1">
    <tr>
      <th>ProjectID</th>
      <th>Title</th>
      <th>Description</th>
      <th>StartDate</th>
      <th>EndDate</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from projects table
    $sql = "SELECT * FROM projects";
    $result = $connection->query($sql);

    // Check if there are any projects records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $project_id = $row['ProjectID']; // Fetch the ProjectID
            echo "<tr>
                    <td>" . $row['ProjectID'] . "</td>
                    <td>" . $row['Title'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['StartDate'] . "</td>
                    <td>" . $row['EndDate'] . "</td>
                    <td><a style='padding:4px' href='projects.php?delete=$project_id' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>
                    <td><a style='padding:4px' href='projects.php?edit=$project_id'>Update</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    // Close the database connection
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
