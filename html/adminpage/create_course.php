<?php
include 'conn_db.php';
session_start();
$course = $_POST['course'];
$description = $_POST['description'];
$numm = $_POST['module_count'];

// SQL query to insert data into the database
$sql = "INSERT INTO courses (course_name, description, module_count) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $course, $description, $numm );


if ($stmt->execute()) {
    $last_id = $stmt->insert_id;
    $_SESSION['id'] = $last_id;
    $_SESSION['modules'] = $numm;
    echo "New course created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$stmt->close();
$conn->close();

?>