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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $stmt = $connection->prepare("INSERT INTO users (Username, Email, Password, Role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $Username, $Email, $Password, $Role);

    $Username = htmlspecialchars($_POST['Username']);
    $Email = htmlspecialchars($_POST['Email']);
    $Password = htmlspecialchars($_POST['Password']);
    $Role = htmlspecialchars($_POST['Role']);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle deletion
if (isset($_GET['delete']) && isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];

    $stmt = $connection->prepare("DELETE FROM users WHERE UserID = ?");
    $stmt->bind_param("i", $UserID);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Page</title>
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
  <h1>User Form</h1>
  <form id="UserForm" method="post" action="">
    <label for="Username">Username:</label>
    <input type="text" id="Username" name="Username" required><br><br>

    <label for="Email">Email:</label>
    <input type="email" id="Email" name="Email" required><br><br>

    <label for="Password">Password:</label>
    <input type="password" id="Password" name="Password" required><br><br>

    <label for="Role">Role:</label>
    <input type="text" id="Role" name="Role" required><br><br>

    <input type="submit" name="add" value="Insert">
  </form>

  <h2>Table of Users</h2>
  <table border="1">
    <tr>
      <th>UserID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Password</th>
      <th>Role</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    $sql = "SELECT * FROM users";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $UserID = $row['UserID'];
            echo "<tr>
                    <td>{$row['UserID']}</td>
                    <td>{$row['Username']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Password']}</td>
                    <td>{$row['Role']}</td>
                    <td><a href='?delete=true&UserID=$UserID' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>
                    <td><a href='update_users.php?UserID=$UserID'>Update</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }

    $connection->close();
    ?>
  </table>
</section>

<footer>

  <!-- Back to Dashboard Link -->
<a class="back-to-dashboard" href="admindashboard.php">Back to Dashboard</a>
  <!-- Footer content here -->
</footer>

</body>
</html>
