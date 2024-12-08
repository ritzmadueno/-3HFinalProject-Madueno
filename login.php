<?php
session_start();
include 'config.php'; // Include your database connection

// If user is already logged in, redirect to the homepage
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If user found, set session and redirect to services page
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        header("Location: index.php"); // Redirect to the homepage after login
        exit();
    } else {
        $error_message = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('spa2.jpg'); /* Optional background image */
            background-size: cover;
            background-position: center;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9); /* Light white background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            font-size: 2.5em;
            color: #57a99a;
            margin-bottom: 20px;
        }

        .login-container p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #555;
        }

        .login-container input {
            width: 75%;
            padding: 15px;
            margin: 10px 0;
            font-size: 1.1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container .button {
            width: 100%;
            padding: 15px;
            background-color: #57a99a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
        }

        .login-container .button:hover {
            background-color: #468f7b;
        }

        .login-container .error {
            color: red;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .login-container .register-link {
            font-size: 1.1em;
            margin-top: 20px;
        }

        .login-container .register-link a {
            color: #57a99a;
            text-decoration: none;
        }

        .login-container .register-link a:hover {
            color: #468f7b;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="button">Login</button>
        </form>

        <!-- Register Link -->
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

</body>
</html>
