<?php
include 'conn_db.php';

$user_id = $_GET['id'];

// Update the application status for the given applicant ID
$sql = "UPDATE applications SET status = 'accepted' WHERE applicant_id = '$user_id'";

// Check if the query was successful
if ($conn->query($sql) === TRUE) {
    echo "Application accepted";
    // Redirect to the applicant list
    header("Location: ../html/applicant_list.php");
    exit(); // Make sure to exit after header to stop further script execution
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
