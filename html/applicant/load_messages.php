<?php
include '../../php/conn_db.php';

$sql = "SELECT * FROM messages ORDER BY timestamp ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div><strong>" . htmlspecialchars($row['user_id']) . "</strong>: " . htmlspecialchars($row['message']) . " <small>(" . $row['timestamp'] . ")</small></div><br>";
    }
} else {
    echo "No messages yet.";
}

$conn->close();
?>
