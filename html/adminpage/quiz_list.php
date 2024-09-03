<?php
include_once "../../php/conn_db.php";
$m_id = $_GET['modules_id'];
$sql = "SELECT * FROM quiz_name WHERE module_id = $m_id ";
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
            <th scope="col">mid</th>
            <th scope="col">title</th>
            <th scope="col">tag</th>
            <th scope="col">total</th>
            <th scope="col">date</th>
        </tr>
        </thead>
         <tbody>
         <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <form class='form' action='quiz_update.php' method='post'>
                            <td><input type='hidden' name='id' value='" . $row['id'] . "'>
                            <td><input type='hidden' name='module_id' value='" . $row['module_id'] . "'>
                            <td><input type='text' name='name' value='" . $row['title'] . "'></td>
                            <td><input type='text' name='tag' value='" . $row['tag'] . "'></td>
                            <td><input type='text' name='total' value='" . $row['total'] . "'></td>
                            <td><input type='submit' value='update'></td>
                            </form>
                            <td><a href='view_question.php?module_id=" . $m_id . "&q_id=" . $row['id'] . "'>quiz list</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No employers found</td></tr>";
            }
            $conn->close();
        ?>


        </tbody>
    </table>
</body>
</html>
