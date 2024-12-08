<?php
session_start();
include 'config.php'; // Include your database connection

// Fetch services from the database
$sql = "SELECT * FROM Services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #88c7bc;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }
        .service {
            padding: 20px;
            margin-bottom: 10px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .service h3 {
            margin: 0;
        }
        .service .button {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            background: #57a99a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Back button styling */
        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 15px;
            background-color: #57a99a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #468f7b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Our Services</h1>
        <!-- Back Button -->
        <button onclick="goBack()" class="back-button">← Go Back</button>
    </div>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="service">
            <h3><?php echo $row['service_name']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <p>Duration: <?php echo $row['duration']; ?> mins</p>
            <p>Price: $<?php echo $row['price']; ?></p>

            <?php
            // Check if the user is logged in
            if (!isset($_SESSION['user_id'])) {
                echo '<a href="login.php" class="button">Login to Book Now</a>';
            } else {
                // If logged in, redirect to booking page
                echo '<a href="booking_page.php?service_id=' . $row['service_id'] . '" class="button">Book Now</a>';
            }
            ?>
        </div>
        <?php endwhile; ?>
    </div>

    <script>
        // JavaScript for the back button functionality
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
