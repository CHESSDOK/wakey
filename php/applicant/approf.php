<?php
include '../conn_db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicant_id = $_POST['userid']; // Assuming the ID is passed in a hidden field
    $first_name = $_POST['first_name'];
    $last_name = $_POST['Last_Name'];
    $middle_name = $_POST['Middle_Name'] ?? '';
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $civil_status = $_POST['Civil_Status']; 
    $photo = 'user.png'; // Default photo

    // Handle the file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $photo = basename($_FILES["photo"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        // If no new photo is uploaded, keep the existing photo
        $result = $conn->query("SELECT photo FROM applicant_profile WHERE id = $applicant_id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $photo = $row['photo'];
        }
    }

    // Update data in database
    $sql = "UPDATE applicant_profile SET 
            first_name = '$first_name', 
            last_name = '$last_name', 
            middle_name = '$middle_name', 
            dob = '$dob', 
            sex = '$sex', 
            civil_status = '$civil_status', 
            photo = '$photo'
            WHERE id = $applicant_id";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
