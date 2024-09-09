<?php
include_once "../../php/conn_db.php";
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ist</title>
</head>
<body>
<table border="1">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">user_info</th>
            <th scope="col">message</th>
            <th scope="col">date</th>
        </tr>
        </thead>
         <tbody>
         <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["user_id"] . "</td>
                        <td>" . $row["message"] . "</td>
                        <td>" . $row["created_at"] . "</td>
                        <td><a href='ofw_chat.php?message_id=" . $row["id"] . "'>quiz list</a></td>
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