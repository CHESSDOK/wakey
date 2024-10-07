<?php
include 'conn_db.php'; // Ensure this file contains the DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $admin_id = $_POST['admin_id'];
  $message_id = $_POST['message_id'];
  $reply = $_POST['reply'];

  // Basic validation: Check if the reply is empty
  if (empty($reply)) {
    echo "Reply cannot be empty!";
  } else {
    // Prepare an SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO replies (message_id, admin_id, reply) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $message_id, $admin_id, $reply); // "iis" means int, int, string

    // Execute the prepared statement
    if ($stmt->execute()) {
      echo "Reply sent successfully!";
    } else {
      echo "Error sending reply: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
  }
}

$conn->close();
?>
