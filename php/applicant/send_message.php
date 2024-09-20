<?php
include '../conn_db.php'; // Ensure this file contains the DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];
  
    $sql = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";
    if ($conn->query($sql) === TRUE) {
      header("Location: ../../html/applicant/ofw_form.php");
    } else {
      echo "Error sending message: " . $conn->error;
    }
  }
?>
