<?php
include 'conn_db.php';
session_start();
$admin = $_SESSION['username'];
// Fetch all employers
$module_id = $_GET['modules_id'];
$sql = "SELECT * FROM module_content WHERE modules_id = $module_id ";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Employer List</title>
</head>
<body>
    <h1>Employer List</h1>
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
                        <td>" . $row["video"] . "</td>
                        <td>" . $row["file_path"] . "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <a href="course.html?username=<?php echo $admin; ?>">courses</a>
</body>
</html>
