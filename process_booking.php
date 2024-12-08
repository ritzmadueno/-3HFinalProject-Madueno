<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$service_id = $_POST['service_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$user_id = $_SESSION['user_id'];

// Insert booking into database
$sql = "INSERT INTO Appointments (service_id, user_id, appointment_date, start_time, status) 
        VALUES ('$service_id', '$user_id', '$date', '$time', 'pending')";

if ($conn->query($sql) === TRUE) {
    // Redirect to homepage
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
