<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: orange;
        }

        .navbar {
            background-color: pink;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Align items vertically */
            padding: 20px 25px;
        }

        .navbar-brand,
        .nav-links li {
            color: orange;
            text-decoration: none;
            font-size: 40px; /* Adjust the font size */
        }

        .nav-links li {
            margin-left: 100px;
            list-style: none;
        }

        .wrapper {
            width: 360px;
            margin: 150px auto;
            background: Yellow;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .wrapper h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .help-block {
            color: #ff0000;
            margin-top: 5px;
        }

        .btn-primary {
            background-color: blue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
    </style>

   
    <!-- Navigation Bar -->
    <header>
        <nav class="navbar">
            <a href="index.php" class="navbar-brand">TMA</a>
            <ul class="nav-links" style="display: flex;">
                <li style="margin-right: 20px;"><a href="home.html">Home</a></li>
                <li style="margin-right: 20px;"><a href="about us.html">About Us</a></li>
                <li><a href="contact us.html">Contact us</a></li>
            </ul>
        </nav>
    </header>



    <!-- PHP code for handling the login -->
    <?php
    session_start();
    require_once 'config.php'; // Ensure you have a config.php file with the database connection details

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Validate inputs
        if (empty($email) || empty($password)) {
            $error = "Please enter both email and password.";
        } else {
            // Prepare the SQL statement
            $sql = "SELECT admin_id, admin_name, email, password FROM admin WHERE email = ?";
            
            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = $email;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if email exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $admin_id, $admin_name, $email, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if ($password === $hashed_password) { // Note: Use password_verify if passwords are hashed using password_hash
                                // Password is correct, start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["admin_id"] = $admin_id;
                                $_SESSION["admin_name"] = $admin_name;

                                // Redirect user to welcome page
                                header("location: admindashboard.php");
                            } else {
                                // Display an error message if password is not valid
                                $error = "The password you entered was not valid.";
                            }
                        }
                    } else {
                        // Display an error message if email doesn't exist
                        $error = "No account found with that email.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($link);
    }
    ?>

    <div class="wrapper">
        <h2>Login</h2>
        <?php 
        if(!empty($error)){
            echo '<div class="help-block">' . $error . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign Up</a></p>
        </form>
    </div>    

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container2">
            <div class="left-part">
                <p class="mb-0">Designed by Tasks Managers Experts</p>
                <p class="mb-0">UR, RN1-HUYE</p>
                <p class="mb-0">contact@tasksmanagement.com</p>
                <p class="mb-0">+250 784933362/ +250 790998550 </p>
            </div>
            <div class="right-part">
                <p class="mb-0">© 2024 Business Strategy Training Platform. All rights reserved.</p>
                <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Faustin</a></p>
                <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Faustin</a></p>
            </div>
        </div>
    </footer>

</body>
</html>
