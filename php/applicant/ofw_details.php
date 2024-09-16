<?php
include '../../php/conn_db.php'; // Include your database connection

function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: ../login.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}

$userId = checkSession(); // Get the current user ID from session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contactNo = $_POST['contactNo'];
    $sex = $_POST['sex'];
    $civilStatus = $_POST['civilStatus'];
    $email = $_POST['email'];
    $houseNo = $_POST['houseNo'];
    $subdivision = $_POST['subdivision'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $sssNo = $_POST['sssNo'];
    $pagibigNo = $_POST['pagibigNo'];
    $philhealthNo = $_POST['philhealthNo'];
    $passportNo = $_POST['passportNo'];
    $immigrationStatus = $_POST['immigrationStatus'];
    $spouseName = $_POST['spouseName'];
    $spouseContact = $_POST['spouseContact'];
    $fathersName = $_POST['fathersName'];
    $fathersAddress = $_POST['fathersAddress'];
    $mothersName = $_POST['mothersName'];
    $mothersAddress = $_POST['mothersAddress'];
    $emergencyContact = $_POST['emergency_contact'];
    $nextOfKinRelationship = $_POST['next_of_kin_relationship'];
    $nextOfKinContact = $_POST['next_of_kin_contact'];
    $educationLevel = $_POST['education_level'];
    $occupation = $_POST['occupation'];

    // Prepare an SQL query to update the applicant_profile table
    $sql = "UPDATE applicant_profile SET 
        first_name = ?, middle_name = ?, last_name = ?, age = ?, dob = ?, contact_no = ?, 
        sex = ?, civil_status = ?, email = ?, house_no = ?, subdivision = ?, barangay = ?, 
        city = ?, province = ?, sss_no = ?, pagibig_no = ?, philhealth_no = ?, passport_no = ?, 
        immigration_status = ?, spouse_name = ?, spouse_contact = ?, fathers_name = ?, 
        fathers_address = ?, mothers_name = ?, mothers_address = ?, emergency_contact = ?, 
        next_of_kin_relationship = ?, next_of_kin_contact = ?, education_level = ?, occupation = ? 
        WHERE user_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the query
        $stmt->bind_param("sssissssssssssssssssssssssssssi",
            $firstName, $middleName, $lastName, $age, $dob, $contactNo,
            $sex, $civilStatus, $email, $houseNo, $subdivision, $barangay,
            $city, $province, $sssNo, $pagibigNo, $philhealthNo, $passportNo,
            $immigrationStatus, $spouseName, $spouseContact, $fathersName,
            $fathersAddress, $mothersName, $mothersAddress, $emergencyContact,
            $nextOfKinRelationship, $nextOfKinContact, $educationLevel, $occupation, $userId
        );

        // Execute the query
        if ($stmt->execute()) {
            echo "Record updated successfully!";
            header("Location: ../../html/applicant/ofw_home.php"); // Redirect to a success page
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
