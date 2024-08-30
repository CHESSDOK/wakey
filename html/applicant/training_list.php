<?php
include '../../php/conn_db.php';
session_start();
$user_id = $_SESSION['id'];

$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>course List</title>
</head>
<body>
    <h1>course List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>course</th>
            <th>desc</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $user_id . "</td>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["course_name"] . "</td>
                        <td>" . $row["description"] . "</td>
                        <td> <a href='modules_list.php?user_id=" . $user_id . "&course_id=" . $row['id'] . "'>open course</a> </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <a href="../../index(applicant).php">back</a>
</body>
</html>