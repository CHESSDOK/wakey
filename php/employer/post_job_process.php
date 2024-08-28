<?php
session_start();

include 'conn_db.php';

$user_id = $_SESSION['id']; // Assume you store the user_id in session after login

// Check if employer documents are verified
$sql = "SELECT COUNT(*) AS count FROM employer_documents WHERE user_id = '$user_id' AND is_verified = TRUE";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];
    $date_posted = date('Y-m-d');

    // Prepare and execute the insertion query
    $stmt = $conn->prepare("INSERT INTO job_postings (employer_id, job_title, job_description, date_posted) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $job_title, $job_description, $date_posted);

    if ($stmt->execute()) {
        // Get the ID of the newly inserted job
        $job_id = $stmt->insert_id;
        // Store the job_id in the session
        $_SESSION['job_id'] = $job_id;

        echo "Job posted successfully! Job ID: " . $job_id;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Your documents are not verified yet. Please wait for verification.";
}

// Close the connection
$conn->close();
?>
