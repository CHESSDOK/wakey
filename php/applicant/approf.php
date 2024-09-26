<?php
include '../conn_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $conn->real_escape_string($_POST['id']);
    
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
            $upload_dir = 'images/';
            
            // Move the file to the uploads directory
            if (move_uploaded_file($image_tmp, $upload_dir . $new_image_name)) {
                // Check if the user exists
                $check_user_sql = "SELECT * FROM applicant_profile WHERE user_id='$userid'";
                $result = $conn->query($check_user_sql);

                if ($result->num_rows > 0) {
                    // Update the user's profile image
                    $sql = "UPDATE applicant_profile SET photo='$new_image_name' WHERE user_id='$userid'";
                    if ($conn->query($sql)) {
                        header("Location: ../../html/applicant/a_profile.php");
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

