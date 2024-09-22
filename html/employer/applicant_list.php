<?php
include '../../php/conn_db.php';
function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: html/login_employer.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}

$userId = checkSession();
// Get user_id from URL
// Fetch documents for the selected employer

$jobid = $_GET['job_id'];

// SQL JOIN to fetch applicant details and their applications
$sql = "SELECT ap.*, a.* 
            FROM applicant_profile ap
            JOIN applications a ON ap.user_id = a.applicant_id
            WHERE a.job_posting_id = $jobid
";
$result = $conn->query($sql);

$sql = "SELECT * FROM empyers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$res = $stmt->get_result();

if (!$res) {
   die("Invalid query: " . $conn->error); 
}

$row = $res->fetch_assoc();
if (!$row) {
   die("User not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>list of applicants</title>
    <link rel="stylesheet" href="../../css/nav_float.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">
            <img src="../../img/logo_peso.png" alt="Logo">
            <a href="#">PESO-lb.ph</a>
        </div>
        <label class="burger" for="burger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="menu">
            <li><a href="../../index(applicant).php">Home</a></li>
            <li><a href="applicant.php">Applicant</a></li>
            <li><a href="" class="active">Training</a></li>
            <li><a href="ofw_home.php">OFW</a></li>
            <li><a href="../../html/about.php">About Us</a></li>
            <li><a href="../../html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
            <button id="emprof"> <?php echo htmlspecialchars($row['username']); ?> </button>
        </div>
    </nav>
    <header>
        <h1 class="h1">Employer Dashboard</h1>
    </header>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Job</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Construct full name
                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];

                echo "<tr>
                        <td>" . htmlspecialchars($row["applicant_id"]) . "</td>
                        <td>" . htmlspecialchars($full_name) . "</td>
                        <td>" . htmlspecialchars($row["job"]) . "</td>
                        <td><a href='applicant_profile.php?user_id=" . htmlspecialchars($row["applicant_id"]) . " &job_id=" . htmlspecialchars($row["job_posting_id"]) . "'>View</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No applicants found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <script src="../javascript/script.js"></script>
</body>
</html>
