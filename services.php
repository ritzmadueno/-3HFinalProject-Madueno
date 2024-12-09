<?php
include 'includes/header.php';
include 'includes/db.php';

// Fetch services
$sql = "SELECT * FROM Services";
$result = $conn->query($sql);
?>

<div class="container">
    <h2>Our Services</h2>
    <div class="services">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="service-card">
                <h3><?php echo $row['service_name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>Duration: <?php echo $row['duration']; ?> minutes</p>
                <p>Price: $<?php echo $row['price']; ?></p>
                <button>Book Now</button>
            </div>
        <?php endwhile; ?>
    </div>
</div>
