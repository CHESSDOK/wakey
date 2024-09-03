<?php
include '../../php/conn_db.php';

$searchQuery = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';

$sql = "SELECT * FROM job_postings WHERE is_active = 1 AND job_title LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $searchQuery);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Invalid query: " . $conn->error);
}

while ($job = $result->fetch_assoc()) {
    echo '<div class="job">';
    echo '<a class="vacant"> No. Vacant </a>'  . '<p>' . htmlspecialchars($job["job_title"]) . '</p>';
    echo '<h2>' . htmlspecialchars($job["job_title"]) .'</h2>'. '<h3 class="vacant-num">' . htmlspecialchars($job["vacant"]) .'</h3>' ;
    echo '<a class="button-img" href="../../html/applicant/apply.php?job=' . urlencode($job["job_title"]) . '"><img src="../../img/document.png" alt="Logo"></a>';
    echo '</div>';
}

$conn->close();
?>
