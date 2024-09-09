<?php
include 'conn_db.php'; // Ensure this file contains the DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $admin_id = $_POST['admin_id'];
  $message_id = $_POST['message_id'];
  $reply = $_POST['reply'];

  $sql = "INSERT INTO replies (message_id, admin_id, reply) VALUES ('$message_id', '$admin_id', '$reply')";
  if ($conn->query($sql) === TRUE) {
    echo "Reply sent successfully!";
  } else {
    echo "Error sending reply: " . $conn->error;
  }
}
?>
