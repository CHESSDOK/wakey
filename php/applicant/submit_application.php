<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job = $_POST['job'];
    $id = intval($_POST['user_id']);
    $job_id = intval($_POST['job_id']);

    // Database connection
    include '../../php/conn_db.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO applications (applicant_id, job_posting_id, job) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $job_id, $job);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../../html/applicant/applicant.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>