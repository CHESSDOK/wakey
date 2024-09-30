<?php
include 'conn_db.php';
// Query to get active job postings
$active_jobs_sql = "SELECT COUNT(*) AS active_job_postings FROM job_postings WHERE is_active = 1";
$result = $conn->query($active_jobs_sql);
$active_job_postings = $result->fetch_assoc()['active_job_postings'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Job Postings</title>
</head>
<body>
    <h1>Active Job Postings</h1>
    <p>Total Active Jobs Posted: <?php echo $active_job_postings; ?></p>
</body>
</html>
<script>
    var activeJobPostings = <?php echo $active_job_postings; ?>;
    console.log("Total Active Job Postings: " + activeJobPostings);
</script>
