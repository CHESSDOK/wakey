<?php
include '../../php/conn_db.php';
session_start();
$userId = $_SESSION['id'];

// Prepare and bind the SQL query to fetch interview schedules for the user
$stmt = $conn->prepare("SELECT * FROM interview WHERE user_id = ? ORDER BY sched_date ASC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Check if a POST request is made to mark an interview as read
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sid = $_POST['id'];
    
    // Prepare and bind the update query
    $update_stmt = $conn->prepare("UPDATE interview SET is_read = 1 WHERE id = ?");
    $update_stmt->bind_param("i", $sid);

    if ($update_stmt->execute()) {
        header("Location: sched_list.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>interview schedules</title>
</head>
<body>
<table border="1">
    <tr>
        <th>Date of interview</th>
        <th>Type of interview</th>
        <th>Link/address</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Format date and time
            $sched = $row['sched_date'] . " " . $row['sched_time'];  
            
            echo "<tr>
                    <form action='sched_list.php' method='post'>
                    <td>" . $sched . "</td>
                    <td>" . $row["interview"] . "</td>
                    <td>" . $row["meeting"] . "</td>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <td><input type='submit' value='Mark as Read'></td>
                    </form>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No interviews found</td></tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>