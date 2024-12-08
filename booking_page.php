<?php
session_start();
include 'config.php';

// Fetch service details from the database if available
$service_id = $_GET['service_id'] ?? '';
$sql = "SELECT * FROM Services WHERE service_id = '$service_id'";
$result = $conn->query($sql);
$service = $result->fetch_assoc();

// Handle the booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST['service_id'];
    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert booking into the database
    $sql = "INSERT INTO Appointments (service_id, user_id, appointment_date, start_time, status) 
            VALUES ('$service_id', '$user_id', '$date', '$time', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Booking confirmed! <a href='index.php'>Go back</a></p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .container h2 {
            font-size: 2.5em;
            color: #57a99a;
            margin-bottom: 20px;
        }
        .container p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #555;
        }
        .form-input {
            width: 75%;
            padding: 15px;
            margin: 10px 0;
            font-size: 1.2em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            color: white;
            background-color: #57a99a;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            width: 100%;
            text-align: center;
        }
        .button:hover {
            background-color: #46988a;
        }
        .service-info {
            padding: 15px;
            margin-bottom: 20px;
            background: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .service-info h3 {
            margin: 0;
            font-size: 1.5em;
        }
        .service-info p {
            margin: 5px 0;
            font-size: 1.1em;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Book Your Spa Treatment</h1>
        <p>Relax and enjoy a rejuvenating experience</p>
    </div>
    <div class="container">
        <div class="service-info">
            <h3><?php echo $service['service_name']; ?></h3>
            <p><strong>Description:</strong> <?php echo $service['description']; ?></p>
            <p><strong>Duration:</strong> <?php echo $service['duration']; ?> minutes</p>
            <p><strong>Price:</strong> $<?php echo $service['price']; ?></p>
        </div>
        
        <form action="booking_page.php?service_id=<?php echo $service['service_id']; ?>" method="POST">
            <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>" class="form-input">
            
            <label for="date">Select Date:</label>
            <input type="date" name="date" required class="form-input">
            
            <label for="time">Select Time:</label>
            <input type="time" name="time" required class="form-input">
            
            <button type="submit" class="button">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
