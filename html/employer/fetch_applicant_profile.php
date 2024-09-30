<?php
include '../../php/conn_db.php';

$applicant_id = $_GET['applicant_id'];

$sql = "SELECT * FROM applicant_profile WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $applicant_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
} else {
    echo "No profile found.";
}
?>
