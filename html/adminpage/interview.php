<?php

include 'conn_db.php'; // Include your MySQLi connection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['applicant_id'];
    $job_id = $_POST['jobid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $type = $_POST['interview'];
    $meeting = $_POST['link'];

    // Step 1: Update the status in applications table
    $sqlUpdateStatus = "UPDATE applications SET status = 'interview' WHERE applicant_id = ? AND job_posting_id = ?";
    $stmtStatus = $conn->prepare($sqlUpdateStatus);
    $stmtStatus->bind_param("ii", $user_id, $job_id);
    
    if ($stmtStatus->execute()) {
        // Step 2: Insert into interview table
        $sqlInsertInterview = "INSERT INTO interview (user_id, job_id, sched_date, sched_time, interview, meeting) 
                               VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInterview = $conn->prepare($sqlInsertInterview);
        $stmtInterview->bind_param("iissss", $user_id, $job_id, $date, $time, $type, $meeting);
        
        header("Location: applicant_list.php?job_id=$job_id");    

        $stmtInterview->close();
    } else {
        echo "Error updating status: " . $stmtStatus->error;
    }

    $stmtStatus->close();
    $conn->close();
}

?>