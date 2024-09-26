
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

$sql = "SELECT jp.*, em.*
                FROM employer_profile em
                JOIN job_postings jp ON em.user_id = jp.employer_id
                WHERE jp.is_active AND jp.job_title LIKE ?";
//$sql = "SELECT * FROM job_postings WHERE is_active = 1 AND job_title LIKE ?";

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
    echo '
    <table class="table table-striped table-hover">
    <tr>
    <td>
        <img src="../../img/logo.png" alt="Logo"></ alt="Company Logo" class="img-fluid" style="max-width: 50px; height: auto;">
    </td>

    <td>
        <strong>' . htmlspecialchars($job["company_name"]) . '</strong><br>
        ' . htmlspecialchars($job["company_address"]) . '<br>
        <a href="mailto:' . htmlspecialchars($job["company_mail"]) . '">' . htmlspecialchars($job["company_mail"]) . '</a><br>
        ' . htmlspecialchars($job["tel_num"]) . '
    </td>

    <!-- Vacant Display -->
    <td>
        <span class="badge ' . ($job["vacant"] === "Yes" ? "bg-success" : "bg-danger") . '">
            ' . ($job['vacant'] === 'Yes' ? 'Vacant' : 'Not Vacant') . '
        </span>
    </td>

    <!-- Apply Icon with Link -->
    <td>
        <a href="../../html/applicant/apply.php?job=' . urlencode($job["job_title"]) . '" class="btn btn-primary">
            Apply <i class="fa fa-arrow-right"></i>
        </a>
    </td>
  </tr>
  </table>';
  
}


// Close the connection
$conn->close();
?>

