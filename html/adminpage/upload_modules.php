<?php
include 'conn_db.php';

$user_id = $_GET['user_id'];
$sql = "SELECT * FROM courses WHERE id = $user_id";  // Replace `1` with the specific course ID if needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the course data
    $row = $result->fetch_assoc();
    $course_id = $row["id"];
    $module_count = $row["module_count"];
} else {
    echo "No courses found.";
    exit; // Stop script execution if no course is found
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
</head>
<body>

<form method="POST" action="save_modules.php" enctype="multipart/form-data">
    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
    <input type="hidden" name="course_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="module_count" value="<?php echo $module_count; ?>"> <!-- Add this line -->

    <?php for ($i = 1; $i <= $module_count; $i++): ?>
        <h3>Module <?php echo $i; ?></h3>

        <label for="module_name_<?php echo $i; ?>">Module Name:</label>
        <input type="text" id="module_name_<?php echo $i; ?>" name="module_name_<?php echo $i; ?>" required><br>
    <?php endfor; ?>

    <input type="submit" value="Save Modules">
</form>
<a href="course_list.php">back</a>
</body>
</html>

