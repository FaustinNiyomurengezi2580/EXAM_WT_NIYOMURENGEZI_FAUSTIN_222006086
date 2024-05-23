<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: tomato;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex; /* Set container to flex */
        }

        .profile-image {
            width: 30%; /* Adjust width of profile image container */
            margin-right: 20px; /* Add margin between image and form */
        }

        .profile-image img {
            width: 100%; /* Ensure image fills container */
            border-radius: 8px; /* Add border radius to image */
        }

        .profile-info {
            width: 70%; /* Adjust width of profile info container */
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Add margin on top of submit button */
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-image">
            <img src="profile.png" alt="Profile Image">
        </div>
        <div class="profile-info">
            <h2>User Profile</h2>
            <form id="profileForm" method="post">
                <label for="userID">User ID:</label>
                <input type="text" id="userID" name="userID" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="" selected disabled>Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <input type="submit" name="submit" value="Submit"> <!-- Added submit button -->
                <input type="submit" name="update" value="Update">
            </form>
        </div>
    </div>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "task_management_application";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Extract form data
        $userID = $_POST['userID'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        if(isset($_POST['submit'])) {
            // Prepare and bind the insert statement
            $stmt = $conn->prepare("INSERT INTO users (Username, Email, Password, Role) VALUES (?, ?, ?, ?)");

            // Bind the parameters
            $stmt->bind_param("ssss", $username, $email, $password, $role);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('User profile saved successfully');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            // Close statement
            $stmt->close();
        } else if(isset($_POST['update'])) {
            // Prepare and bind the update statement
            $stmt = $conn->prepare("UPDATE users SET Username=?, Email=?, Password=?, Role=? WHERE UserID=?");

            // Bind the parameters
            $stmt->bind_param("ssssi", $username, $email, $password, $role, $userID);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('User profile updated successfully');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
