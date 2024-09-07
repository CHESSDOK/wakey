<?php
include 'conn_db.php'; // Ensure this file contains the correct DB connection

// Check if admin message is being posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminid = $_POST['adminid'];
    $message = $_POST['admin_message'];

    // Insert into database
    $sql = "INSERT INTO messages (user_id, message, is_admin) VALUES ('$adminid', '$message', 1)";

    if ($conn->query($sql) === TRUE) {
        header('Location: ofw_chat.php');
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No message received!";
}

$conn->close();
?>
