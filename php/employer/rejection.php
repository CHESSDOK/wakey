<?php
include '../../php/conn_db.php';
$user_id = $_GET['id'];
$job_id = $_GET['job_id'];

    // Update the data in the quiz_name table
    $sql = "UPDATE applications SET status = 'rejected' WHERE applicant_id = '$user_id' AND job_posting_id = $job_id";

        if (mysqli_query($conn, $sql)) {
            // Redirect to the add_question page with parameters
            header("Location: ../../html/applicant/applicant_list.php?job_id=$job_id&job_id = $job_id");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    mysqli_close($conn);
?>
