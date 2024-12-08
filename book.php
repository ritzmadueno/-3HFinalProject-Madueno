<?php
session_start();
include 'config.php'; // Include your database connection

// Fetch available services from the database
$sql_services = "SELECT * FROM Services";
$services_result = $conn->query($sql_services);
?>

<form action="process_booking.php" method="POST">
    <input type="hidden" name="service_id" value="<?php echo $service_id; ?>"> <!-- Service ID from DB -->
    <input type="date" name="date" required>
    <input type="time" name="time" required>

    <!-- Select Service -->
    <label for="service">Select Service:</label>
    <select name="service_id" required>
        <?php while ($service = $services_result->fetch_assoc()): ?>
            <option value="<?php echo $service['service_id']; ?>"><?php echo $service['service_name']; ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Confirm Booking</button>
</form>
