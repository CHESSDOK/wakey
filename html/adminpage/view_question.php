<?php

include '../../php/conn_db.php';
$q_id = $_GET['q_id'];
$module_id = $_GET['module_id'];

$sql = "SELECT * FROM question WHERE quiz_id = $q_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Questions</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>question</th>
            <th>option</th>
            <th>correct_answer</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["question"] . "</td>
                        <td>A)." . $row["option_a"] ."<br>B).".  $row["option_b"] ."<br>C).". $row["option_c"] ."<br>D).". $row["option_d"] .  "</td>
                        <td>" . $row["correct_answer"] . "</td>
                       </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>


</div>

</body>

</html>

