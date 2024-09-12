<?php
include_once "../../php/conn_db.php";
$module_id = $_GET['modules_id'];
$sql = "SELECT * FROM quiz_name WHERE module_id = $module_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz List</title>
</head>
<body>

    <table border="1">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">tag</th>
            <th scope="col">total</th>
        </tr>
        </thead>
         <tbody>
         <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["tag"] . "</td>
                            <td>" . $row["total"] . "</td>
                            <td><a href='take_exam.php?module_id=" . $module_id . "&q_id=" . $row['id'] . "'>take quiz</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No employers found</td></tr>";
            }
            $conn->close();
        ?>

            <a href="module_content.php">back</a>
        </tbody>
    </table>
</body>
</html>
