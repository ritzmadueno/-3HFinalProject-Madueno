<?php
include 'config.php';

// Check if the form was submitted and required fields exist
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['service_id'], $_POST['date'], $_POST['time'])) {
    // Get form data
    $service_id = $_POST['service_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Assuming the user is logged in, fetch the user_id (you can replace this with session-based logic)
    session_start();
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login if the user is not logged in
        header("Location: login.php");
        exit;
    }
    $user_id = $_SESSION['user_id'];

    // Insert booking into the database
    $sql = "INSERT INTO Appointments (service_id, user_id, appointment_date, start_time, status) 
            VALUES ('$service_id', '$user_id', '$date', '$time', 'pending')";

    if ($conn->query($sql) === TRUE) {
        // Fetch the newly inserted appointment details
        $appointment_id = $conn->insert_id;
        $sql_appointment = "SELECT * FROM Appointments WHERE appointment_id = $appointment_id";
        $appointment_result = $conn->query($sql_appointment);
        $appointment = $appointment_result->fetch_assoc();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid booking details.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Booking is Confirmed!</h1>

        <?php if (isset($appointment)): ?>
            <p><strong>Service:</strong> <?php echo $appointment['service_id']; ?> (Service Name from DB)</p>
            <p><strong>Date:</strong> <?php echo $appointment['appointment_date']; ?></p>
            <p><strong>Time:</strong> <?php echo $appointment['start_time']; ?></p>
            <p>Status: <?php echo $appointment['status']; ?></p>
            <a href="index.php">Go Back to Homepage</a>
        <?php else: ?>
            <p>There was an error confirming your booking. Please try again.</p>
        <?php endif; ?>
    </
