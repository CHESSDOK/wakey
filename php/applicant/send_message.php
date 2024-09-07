<?php
include '../conn_db.php'; // Ensure this file contains the DB connection

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];  // Get the user ID from the form
    $message = $_POST['message'];  // Get the message from the form

    // Prepare the SQL query to insert the message into the database
    $sql = "INSERT INTO messages (user_id, message) VALUES ('$userid', '$message')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the chat page after successful insertion
        header('Location: ../../html/applicant/ofw_chat.php');
        exit(); // Make sure to call exit() after redirection
    } else {
        // Display error message if the query fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
