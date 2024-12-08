<?php
session_start();
include 'config.php';

// Check if user is logged in, otherwise redirect to login page
if (isset($_SESSION['user_id'])) {
    header("Location: services.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Spa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            width: 100%;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.9); /* Light white background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 2.5em;
            color: #57a99a;
            margin-bottom: 20px;
        }

        .header p {
            font-size: 1.2em;
            color: #555;
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #57a99a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #468f7b;
        }

        .footer {
            margin-top: 30px;
            color: #555;
            font-size: 1.1em;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Welcome to Our Spa</h1>
            <p>Relax, Rejuvenate, and Feel Your Best</p>
        </div>

        <!-- Check if the user is logged in, and show buttons accordingly -->
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="button">Login</a>
        <?php else: ?>
            <a href="services.php" class="button">Browse Services</a>
        <?php endif; ?>

        <div class="footer">
            <p>&copy; 2024 Our Spa | All Rights Reserved</p>
        </div>
    </div>

</body>
</html>
