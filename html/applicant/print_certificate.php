<?php
include '../../php/conn_db.php';
session_start();

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;

if ($user_id && $course_id) {
    // Fetch user details
    $stmt = $conn->prepare("SELECT * FROM applicant_profile WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    
    if ($user_result->num_rows > 0) {
        $user_data = $user_result->fetch_assoc();
        $fullname = $user_data['last_name'] . ", " . $user_data['first_name'] . " " . $user_data['middle_name'] . "";
    } else {
        die("User not found.");
    }

    // Fetch course details
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $course_result = $stmt->get_result();
    
    if ($course_result->num_rows > 0) {
        $course_data = $course_result->fetch_assoc();
    } else {
        die("Course not found.");
    }
} else {
    die("Invalid request. Missing user_id or course_id.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .certificate {
            border: 2px solid #000;
            padding: 20px;
            text-align: center;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
        }
    </style>
</head>
<body>

<div class="certificate">
    <h1>Certificate of Completion</h1>
    <p>This is to certify that</p>
    <h2><?php echo htmlspecialchars($fullname); ?></h2>
    <p>has successfully completed the course</p>
    <h3><?php echo htmlspecialchars($course_data['course_name'])."."; ?></h3>
    <p>All modules have been passed.</p>
    <p>Issued on: <?php echo date("Y-m-d"); ?></p>
</div>

<script>
    window.print(); // Automatically trigger print dialog
</script>

</body>
</html>
