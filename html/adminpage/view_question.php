<?php
include '../../php/conn_db.php';
$q_id = $_GET['quiz_id'];
$module_id = $_GET['module_id'];

$sql = "SELECT * FROM question WHERE quiz_id = $q_id";
$result = $conn->query($sql);

echo "  <h2>Quiz Items</h2>
        <table class='table table-borderless table-hover'>
        <thead>
            <th>Question</th>
            <th>Option</th>
            <th>Correct Answer</th>
        </thead>
     ";
     if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["question"] . "</td>
                    <td>A)." . $row["option_a"] ."<br>B).".  $row["option_b"] ."<br>C).". $row["option_c"] ."<br>D).". $row["option_d"] .  "</td>
                    <td>" . $row["correct_answer"] . "</td>
                   </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No employers found</td></tr></table>";
    }
    $conn->close();
?>

