<?php
session_start();
require 'conn_db.php';  // Include database connection

// Check if admin is logged in
$admin = $_SESSION['username'];

// Fetch all cases
$sql = "SELECT c.id, a.first_name, c.title, c.status, c.created_at 
        FROM cases c 
        JOIN applicant_profile a ON c.user_id = a.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cases</title>
</head>
<body>
    <h2>All Filed Cases</h2>
    <table border="1">
        <tr>
            <th>Case ID</th>
            <th>User</th>
            <th>Title</th>
            <th>Status</th>
            <th>Date Filed</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="ofw_chat.php">chat with admin</a>
</body>
</html>
