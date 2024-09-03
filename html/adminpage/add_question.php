<?php

include '../../php/conn_db.php';
$q_id = $_GET['q_id'];
$module_id = $_GET['module_id'];
$total = $_GET['total'];


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
<div class="form-box">
    <form class="form" action="save_question.php" method="post">

        <span class="title">Enter Questions</span>

        <input type="hidden" name="eid" value="<?php echo $q_id; ?>">
        <input type="hidden" name="mid" value="<?php echo $module_id; ?>">
        <?php

        for($i = 1; $i <= $total; $i++) {

            echo '<div class="form-container">

                    <input type="text" class="input" name="questions[]" placeholder="Question ' . $i . '" required>

                    <input type="text" class="input" name="option_a[]" placeholder="Option A" required>

                    <input type="text" class="input" name="option_b[]" placeholder="Option B" required>

                    <input type="text" class="input" name="option_c[]" placeholder="Option C" required>

                    <input type="text" class="input" name="option_d[]" placeholder="Option D" required>

                    <select name="correct_answer[]" class="input" required>

                        <option value="">Select correct answer</option>

                        <option value="a">Option A</option>

                        <option value="b">Option B</option>

                        <option value="c">Option C</option>

                        <option value="d">Option D</option>

                    </select>

                </div>';

        }

        ?>

        <button type="submit" name="save">SAVE QUESTIONS</button>

    </form>

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

