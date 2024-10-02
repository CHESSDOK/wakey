<?php
include '../../php/conn_db.php';

$user_id = $_GET['module_id']; // Make sure to sanitize this if not already done
$sql = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $course_id = $row["id"];
    $module_count = $row["module_count"];
    echo "<h2>" .$row['course_name']. "  </h2>";
    for ($i = 1; $i <= $module_count; $i++) {
        echo "
            <form method='POST' action='save_modules.php' enctype='multipart/form-data'>
            <input type='hidden' name='course_id' value='$course_id'>
            <input type='hidden' name='module_count' value='$module_count'>
            
            <div class='upl-container'>
            <input class='form-control upl-input' type='text' id='module_name_$i' 
                   name='module_name_$i' placeholder='Module $i' required>
            </div>";

    }
    echo "
            <input class='btn btn-primary mt-2' type='submit' value='Save Modules'>
            </form>
         ";
    
} else {
    echo "No profile found.";
}
?>