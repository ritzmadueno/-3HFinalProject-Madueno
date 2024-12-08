<?php
include 'config.php'; // Include your database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user'; // Default role for new users

    // Check if passwords match
    if ($password != $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

        .register-container {
            background-color: rgba(255, 255, 255, 0.9); /* Light white background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .register-container h2 {
            font-size: 2.5em;
            color: #57a99a;
            margin-bottom: 20px;
        }

        .register-container p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #555;
        }

        .register-container input {
            width: 75%;
            padding: 15px;
            margin: 10px 0;
            font-size: 1.1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .register-container .button {
            width: 100%;
            padding: 15px;
            background-color: #57a99a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
        }

        .register-container .button:hover {
            background-color: #468f7b;
        }

        .register-container .error {
            color: red;
            font-size: 1.2em;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
        <form action="register.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" class="button">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
