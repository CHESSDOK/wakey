<?php


include '../../php/conn_db.php';

$sql = "SELECT * FROM job_postings WHERE is_active = 1";
$result = $conn->query($sql);
if (!$result) {
    die("Invalid query: " . $conn->error);
}

while ($job = $result->fetch_assoc()) {
    echo '<div class="job">';
    echo '<h2>' . htmlspecialchars($job["job_title"]) . '</h2>';
    echo '<p>' . htmlspecialchars($job["job_description"]) . '</p>';
    echo '<a href="../../html/applicant/apply.php?job=' . urlencode($job["job_title"]) . '" class="apply-button">Apply Now</a>';
    echo '</div>';
}

$conn->close();
?>
