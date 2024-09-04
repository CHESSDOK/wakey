<?php
include "../../php/conn_db.php";
$q_id = $_GET['q_id'];
$module_id = $_GET['module_id'];

$questions_query = "SELECT * FROM question WHERE quiz_id='$q_id'";
$questions_result = mysqli_query($conn, $questions_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Exam</title>
</head>
<body>
    <form class="form-box" action="../../php/applicant/submit_ans.php" method="POST">
        <input type="hidden" name="q_id" value="<?php echo htmlspecialchars($q_id); ?>">
        <input type="hidden" name="module_id" value="<?php echo htmlspecialchars($module_id); ?>">
        <?php
        $q_number = 1;
        while ($question = mysqli_fetch_assoc($questions_result)) {
            echo "<div class='question'>
                <p>Question {$q_number} :: " . htmlspecialchars($question['question']) . "</p>
                <input type='hidden' name='questions[]' value='{$question['id']}'>
                <label><input type='radio' name='answers[{$question['id']}]' value='a'> " . htmlspecialchars($question['option_a']) . "</label><br>
                <label><input type='radio' name='answers[{$question['id']}]' value='b'> " . htmlspecialchars($question['option_b']) . "</label><br>
                <label><input type='radio' name='answers[{$question['id']}]' value='c'> " . htmlspecialchars($question['option_c']) . "</label><br>
                <label><input type='radio' name='answers[{$question['id']}]' value='d'> " . htmlspecialchars($question['option_d']) . "</label><br>
            </div>";
            $q_number++;
        }
        ?>
        <button  class="action" type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
