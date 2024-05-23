<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tag Page</title>
   <style> /* CSS styles */
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

/* Specific styling for the tags form */
form#TagForm {
  background-color: yellow; /* Add yellow background color */
  padding: 20px;
  border-radius: 10px;
}

form#TagForm label {
  display: block;
  margin-top: 10px;
}

form#TagForm input[type="number"],
form#TagForm input[type="text"],
form#TagForm textarea {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#TagForm input[type="date"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form#TagForm input[type="submit"] {
  margin-top: 20px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: darkgreen;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s;
}

form#TagForm input[type="submit"]:hover {
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
  <!-- Tag Form -->
  <h1>Tag Form</h1>

  <form id="TagForm" method="post">
    <label for="TagName">TagName:</label>
    <input type="text" id="TagName" name="TagName" required><br><br>
    <input type="submit" name="add" value="Insert" onclick="return confirmInsertion();" class="button">
  </form>

  <!-- JavaScript code for form submission confirmation -->
  <script>
    function confirmInsertion() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>

  <!-- PHP code for form submission and displaying records -->
  <?php
include('database_connection.php');

// Inserting a new tag
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO tags (TagName) VALUES (?)");
        $stmt->bind_param("s", $TagName);

        // Set parameters from POST data with validation (optional)
        $TagName = htmlspecialchars($_POST['TagName']); // Prevent XSS

        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Deleting a tag
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['TagID'])) {
    $TagID = $_GET['TagID'];
    $delete_query = "DELETE FROM tags WHERE TagID = $TagID";
    if ($connection->query($delete_query) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}

// Updating a tag
if(isset($_POST['update'])) {
    $TagID = $_POST['TagID'];
    $TagName = htmlspecialchars($_POST['TagName']);
    $update_query = "UPDATE tags SET TagName='$TagName' WHERE TagID='$TagID'";
    if ($connection->query($update_query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

// Fetching and displaying tags
$sql = "SELECT * FROM tags";
$result = $connection->query($sql);

echo "<h2>Table of Tags</h2>";
echo "<table border='1'>
    <tr>
        <th>TagID</th>
        <th>TagName</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $TagID = $row['TagID'];
        echo "<tr>
                <td>" . $row['TagID'] . "</td>
                <td>" . $row['TagName'] . "</td>
                <td><a style='padding:4px' href='?action=delete&TagID=$TagID' class='button'>Delete</a></td>
                <td><a style='padding:4px' href='#' onclick='openUpdateForm($TagID,\"".$row['TagName']."\")' class='button'>Update</a></td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}

echo "</table>";

// Update form
echo "<div id='updateForm' style='display:none;'>
        <h2>Update Tag</h2>
        <form method='post'>
            <input type='hidden' name='TagID' id
        <h2>Update Tag</h2>
        <form method='post'>
            <input type='hidden' name='TagID' id='updateTagID'>
            <label for='updateTagName'>TagName:</label>
            <input type='text' id='updateTagName' name='TagName' required><br><br>
            <input type='submit' name='update' value='Update' class='button'>
        </form>
    </div>";

$connection->close();
?>

<script>
    function openUpdateForm(TagID, TagName) {
        document.getElementById('updateTagID').value = TagID;
        document.getElementById('updateTagName').value = TagName;
        document.getElementById('updateForm').style.display = 'block';
    }
</script>


</section>

<footer>
  <!-- Footer content -->
  <!-- Include your footer content here -->
</footer>

<!-- Back to Dashboard Link -->
<a class="back-to-dashboard" href="admindashboard.php">Back to Dashboard</a>

</body>
</html>
