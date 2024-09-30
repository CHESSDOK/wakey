<?php
include '../../php/conn_db.php';

$applicant_id = $_GET['applicant_id'];

$sql = "SELECT * FROM applicant_profile WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $applicant_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
} else {
    echo "No profile found.";
}
?>
<?php
include '../../php/conn_db.php';

$course_id = $_GET['modules_id'];

$course_id = $_GET['modules_id'];  // Make sure to sanitize this if not already done
$sql = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $course_id = $row["id"];
    $module_count = $row["module_count"];
    for ($i = 1; $i <= $module_count; $i++){
        echo "<form method='post' action='your-action-url'>
                <input class='form-control upl-input' type='text' id='module_name_'.$i'' 
                            name='module_name_'.$i'' placeholder='Module'.$i' required> <br>
                <input class='btn btn-primary mt-3' type='submit' value='Save Modules'>
                </form>
             ";
    }
    
} else {
    echo "No profile found.";
}
?>
