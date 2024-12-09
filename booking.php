<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $therapist_id = $_POST['therapist_id'];
    $service_id = $_POST['service_id'];
    $appointment_date = $_POST['appointment_date'];
    $start_time = $_POST['start_time'];

    // Calculate end time based on service duration
    $sql = "SELECT duration FROM Services WHERE service_id = $service_id";
    $result = $conn->query($sql);
    $duration = $result->fetch_assoc()['duration'];
    $end_time = date('H:i:s', strtotime("+$duration minutes", strtotime($start_time)));

    $sql = "INSERT INTO Appointments (user_id, therapist_id, service_id, appointment_date, start_time, end_time) 
            VALUES ($user_id, $therapist_id, $service_id, '$appointment_date', '$start_time', '$end_time')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
