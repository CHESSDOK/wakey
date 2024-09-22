<?php

include '../conn_db.php'; // Include your MySQLi connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['applicant_id'];
    $job_id = $_POST['jobid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $type = $_POST['interview'];
    $meeting = $_POST['link'];

    // Prepare the SQL statement
    $sql = "INSERT INTO interview (user_id, job_id, sched_date, sched_time, interview, meeting) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare the statement with MySQLi
    $stmt = $conn->prepare($sql);

    // Bind parameters (i for integer, s for string)
    $stmt->bind_param("iissss", $user_id, $job_id, $date, $time, $type, $meeting);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../../html/employer/job_list.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
