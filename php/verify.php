<?php
include 'conn_db.php';

if (isset($_GET['token'])) {
    $token = $conn->real_escape_string($_GET['token']);
    $sql = "SELECT * FROM register WHERE token='$token' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $update_query = "UPDATE register SET is_verified=1 WHERE token='$token'";

        if ($conn->query($update_query) === TRUE) {
            echo "Email verification successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid token.";
    }
} else {
    echo "No token provided.";
}

$conn->close();
?>
