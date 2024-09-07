<?php
include 'conn_db.php';

// Fetch all chat messages in order of timestamp
$sql = "SELECT * FROM messages ORDER BY timestamp ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check if the message is from the admin
        if ($row['is_admin']) {
            echo "<div style='color: blue;'><strong>Admin:</strong> " . htmlspecialchars($row['message']) . " <small>(" . $row['timestamp'] . ")</small></div><br>";
        } else {
            echo "<div><strong>User " . htmlspecialchars($row['user_id']) . ":</strong> " . htmlspecialchars($row['message']) . " <small>(" . $row['timestamp'] . ")</small></div><br>";
        }
    }
} else {
    echo "No messages yet.";
}

$conn->close();
?>
