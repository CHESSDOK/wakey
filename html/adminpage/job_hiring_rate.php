<?php
include 'conn_db.php';

// Query to get total applications
$total_sql = "SELECT COUNT(DISTINCT applicant_id) AS total_applications FROM applications";
$result = $conn->query($total_sql);
$total_applications = $result->fetch_assoc()['total_applications'];

// Query to get hired applications
$hired_sql = "SELECT COUNT(DISTINCT applicant_id) AS hired_applications FROM applications WHERE status = 'accepted'";
$result = $conn->query($hired_sql);
$hired_applications = $result->fetch_assoc()['hired_applications'];

// Calculate the total hiring rate
if ($total_applications > 0) {
    $hiring_rate = ($hired_applications / $total_applications) * 100;
} else {
    $hiring_rate = 0; // Avoid division by zero
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Job Hiring Rate</title>
</head>
<body>
    <h1>Total Job Hiring Rate</h1>
    <p>Total Applications: <?php echo $total_applications; ?></p>
    <p>Hired Applications: <?php echo $hired_applications; ?></p>
    <p>Hiring Rate: <?php echo round($hiring_rate, 2); ?>%</p>
</body>
</html>
<script>
    var totalApplications = <?php echo $total_applications; ?>;
    var hiredApplications = <?php echo $hired_applications; ?>;
    var hiringRate = (hiredApplications / totalApplications) * 100;

    console.log("Total Hiring Rate: " + hiringRate.toFixed(2) + "%");
</script>
