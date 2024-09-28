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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $company_add = $_POST['company_add'];
    $tel_num = $_POST['tel_num'];
    $president = $_POST['president'];
    $HR = $_POST['HR'];
    $company_mail = $_POST['company_mail'];
    $HR_mail = $_POST['HR_mail'];
    
    // Check if a file was uploaded
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $image_name = $_FILES['profile_image']['name'];
        $image_tmp = $_FILES['profile_image']['tmp_name'];
        $image_size = $_FILES['profile_image']['size'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        // Allow only specific image formats
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($image_ext, $allowed_extensions)) {
            // Rename the image to prevent conflicts
            $new_image_name = uniqid() . '.' . $image_ext;

            // Upload directory
            $upload_dir = 'uploads/';
            
            // Move the file to the uploads directory
            if (move_uploaded_file($image_tmp, $upload_dir . $new_image_name)) {
                // Check if the user exists
                $check_user_sql = "SELECT * FROM employer_profile WHERE user_id='$userId'";
                $result = $conn->query($check_user_sql);

                if ($result->num_rows > 0) {
                    // Update the user's profile image
                    $sql = "UPDATE `employer_profile`
                            SET company_name='$company_name', company_address='$company_add', tel_num='$tel_num', 
                                president='$president', HR='$HR', company_mail='$company_mail', HR_mail='$HR_mail',
                                photo ='$new_image_name'
                            WHERE user_id ='$userId'";
                    if ($conn->query($sql)) {
                        header("Location: ../../html/employer/employer_profile.php");
                    } else {
                        echo "Error updating profile image: " . $conn->error;
                    }
                } else {
                    echo "User not found.";
                }
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            echo "Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "No image uploaded.";
    }
}

$conn->close();
?>
