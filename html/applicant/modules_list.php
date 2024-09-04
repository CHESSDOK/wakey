<?php
include '../../php/conn_db.php';
session_start();
$user_id = $_GET['user_id'];
// Fetch all employers
$module_id = $_GET['course_id'];
$sql = "SELECT * FROM modules WHERE course_id = $module_id ";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>module list</title>
</head>
<body>
    <h1>module list</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        " . $row["id"] . "
                        " . $row["module_name"] . "
                        <a href='module_content.php?user_id=" . $user_id . "&modules_id=" . $row["id"] . "'>view content</a>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
