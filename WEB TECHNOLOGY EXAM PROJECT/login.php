<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            background-color: pink;
            background-repeat: no-repeat;
            background-size: cover;
        }

        h2 {
            background-color: skyblue;
            width: 500px;
            height: 50px;
            padding: 10px;
            margin-bottom: 20px;
        }

        form {
            background-color: beige;
            width: 500px;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
        }

        label {
            font-size: 20px;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #message {
            margin-top: 10px;
            color: green;
        }

        .error {
            color: red;
        }

        .link-container {
            margin: 10px 0;
        }

        .link-container a {
            text-decoration: none;
            color: #0073e6;
        }

        .link-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <center>
        <h2>Login Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">UserName:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div class="link-container">
                <a href="reset password.php">Forgot Password</a>
            </div>
            <input type="submit" value="Login">
            <input type="reset" value="Cancel">
            <p><i>Don't you have an account?</i> <a href="register.php">Create New Account</a></p>
        </form>
    </center>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "task_management_application";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    session_start(); // Start the session

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare SQL statement to retrieve user data by username
        $sql = "SELECT UserID, Password FROM users WHERE Username=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Fetch user data
            $row = $result->fetch_assoc();

            // Verify password
            if ($password == $row['Password']) {  // Compare passwords directly (not recommended)
                // Password is correct, set session variable and redirect to user dashboard
                $_SESSION['UserID'] = $row['UserID'];
                header("Location: users dashboard.php"); // Update the redirection URL
                exit();
            } else {
                // Password is incorrect
                echo "<p class='error'>Invalid username or password</p>";
            }
        } else {
            // User not found
            echo "<p class='error'>User not found</p>";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $connection->close();
    ?>
</body>
</html>
