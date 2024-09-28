<?php
include 'conn_db.php';

$user_id = $_GET['id'];

// Update the application status for the given applicant ID
$sql = "UPDATE applications SET status = 'accepted' WHERE applicant_id = '$user_id'";

if ($conn->query($sql) === TRUE) {
    // Fetch the job_id related to the applicant
    $job_id_query = "SELECT job_posting_id FROM applications WHERE applicant_id = '$user_id'";
    $result = $conn->query($job_id_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $job_id = $row['job_posting_id'];

        // Subtract 1 from the vacant column in the job_posting table, and ensure vacant is positive
        $update_vacant_sql = "UPDATE job_postings SET vacant = GREATEST(vacant - 1, 0) WHERE j_id = '$job_id'";

        if ($conn->query($update_vacant_sql) === TRUE) {
            echo "Application accepted and vacant position updated.";
        } else {
            echo "Error updating vacant position: " . $conn->error;
        }
    } else {
        echo "Job posting not found for this applicant.";
    }

    // Redirect to the applicant list
    header("Location: ../../html/employer/applicant_list.php?job_id=".$job_id);
    exit(); // Ensure to stop further script execution
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
