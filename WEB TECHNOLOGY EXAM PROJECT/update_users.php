<?php
include('database_connection.php');

// Check if UserID is set and valid
if (isset($_GET['UserID']) && is_numeric($_GET['UserID'])) {
    $UserID = $_GET['UserID'];

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE UserID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $UserID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Display the update form with pre-filled values
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
        </head>
        <body>
            <h2>Update User</h2>
            <form method="post" action="">
                <input type="hidden" name="UserID" value="<?php echo $row['UserID']; ?>">
                <label for="Username">Username:</label>
                <input type="text" id="Username" name="Username" value="<?php echo $row['Username']; ?>"><br><br>
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" value="<?php echo $row['Email']; ?>"><br><br>
                <label for="Password">Password:</label>
                <input type="password" id="Password" name="Password" value="<?php echo $row['Password']; ?>"><br><br>
                <label for="Role">Role:</label>
                <input type="text" id="Role" name="Role" value="<?php echo $row['Role']; ?>"><br><br>
                <input type="submit" name="update" value="Update">
            </form>
        </body>
        </html>
        
        <?php
    } else {
        echo "User not found!";
    }
} else {
    echo "Invalid UserID";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $UserID = $_POST['UserID'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Role = $_POST['Role'];

    // Update user information in the database
    $sql = "UPDATE users SET Username=?, Email=?, Password=?, Role=? WHERE UserID=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $Username, $Email, $Password, $Role, $UserID);
    
    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $stmt->error;
    }
    
    $stmt->close();
}

$connection->close();
?>
