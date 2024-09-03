<?php
include '../../php/conn_db.php';
session_start();
$user_id = $_GET['user_id'];
// Fetch all employers
$module_id = $_GET['modules_id'];
$sql = "SELECT * FROM module_content WHERE modules_id = $module_id ";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Employer List</title>
</head>
<body>
    <h1>content</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Descrtption</th>
            <th>video</th>
            <th>file</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["description"] . "</td>
                        <td><a href='" . $row["video"] . "' target='_blank'>View Video</a></td>
                        <td><a href='" . $row["file_path"] . "' target='_blank'>Open File</a></td>
                        <td><a href='quiz_list.php?modules_id=" . $row["id"] ."'>take quiz</a></td>

                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <a href="modules_list.php?user_id=<?php echo $user_id; ?>&course_id=<?php echo $module_id; ?>">courses</a>
</body>
</html>
