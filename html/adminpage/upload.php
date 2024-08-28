<?php
// Database connection
include 'conn_db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $description = $_POST['desc'];
    $videoLink = $_POST['link'];
    $modules_id = $_POST['mod_id'];

    // Directory to upload files
    $uploadDir = "uploads/";

    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Process each file
    foreach ($_FILES['files']['name'] as $key => $filename) {
        $targetFilePath = $uploadDir . basename($filename);

        // Upload file to server
        if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $targetFilePath)) {
            // Insert file and other data into database
            $sql = "INSERT INTO module_content (modules_id, description, file_path, video) 
                    VALUES ('$modules_id', '$description', '$targetFilePath', '$videoLink')";

            if ($conn->query($sql) === TRUE) {
                echo "File " . htmlspecialchars(basename($filename)) . " has been uploaded and saved to the database.<br>";
            } else {
                echo "Database error: " . $conn->error . "<br>";
            }
        } else {
            echo "Error uploading file: " . htmlspecialchars(basename($filename)) . "<br>";
        }
    }
}

$conn->close();
?>
