<?php
include 'conn_db.php';
function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: ../../html/employer/login_employer.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}

$userId = checkSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $company_name = $_POST['company_name'];
    $company_add = $_POST['company_add'];
    $tel_num = $_POST['tel_num'];
    $president = $_POST['president'];
    $HR = $_POST['HR'];
    $company_mail = $_POST['company_mail'];
    $HR_mail = $_POST['HR_mail'];


    // Create the SQL query to update the employer profile
    $sql = "UPDATE `employer_profile`
            SET company_name='$company_name', company_address='$company_add', tel_num='$tel_num', 
                president='$president', HR='$HR', company_mail='$company_mail', HR_mail='$HR_mail'
            WHERE user_id ='$userId'";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        // Redirect to job creation page on success
        header("Location: ../../html/employer/job_creat.php");
        exit();
    } else {
        // Output error message on failure
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
