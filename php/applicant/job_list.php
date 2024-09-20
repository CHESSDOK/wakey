<?php
include '../../php/conn_db.php';
$userId = $_SESSION['id']; // Assuming you have the logged-in user's ID available

// Fetch user's specialization
$sqlUser = "SELECT specialization FROM applicant_profile WHERE user_id = ?";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

// Prepare the search query (if there's a search input)
$searchQuery = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';

// Base SQL for fetching jobs
$sql = "SELECT * FROM job_postings WHERE is_active = 1 AND job_title LIKE ?";

// Modify SQL if the user has a specialization
if ($user['specialization']) {
    $sql .= " AND specialization = ?";
}

// Prepare the SQL query
$stmt = $conn->prepare($sql);

// Bind parameters based on specialization availability
if ($user['specialization']) {
    $stmt->bind_param("ss", $searchQuery, $user['specialization']);
} else {
    $stmt->bind_param("s", $searchQuery);
}

// Execute the query and get results
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Invalid query: " . $conn->error);
}

// Display the jobs
while ($job = $result->fetch_assoc()) {
    echo '<div class="job">';
    echo '<a class="vacant"> No. Vacant </a>'  . '<p>' . htmlspecialchars($job["job_title"]) . '</p>';
    echo '<h2>' . htmlspecialchars($job["job_title"]) . '</h2>'. '<h3 class="vacant-num">' . htmlspecialchars($job["vacant"]) . '</h3>';
    echo '<a class="button-img" href="../../html/applicant/apply.php?job=' . urlencode($job["job_title"]) . '"><img src="../../img/document.png" alt="Logo"></a>';
    echo '</div>';
}

// Close the connection
$conn->close();
?>

