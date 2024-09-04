<?php
session_start();
include_once "../../php/conn_db.php";

$user_id = $_SESSION['id'];
$eid = $_GET['q_id'];
$module_id = $_GET['module_id'];

// Fetch user score data for the exam
$score_query = "SELECT * FROM user_score WHERE user_id='$user_id' AND quiz_id='$eid'";
$score_result = mysqli_query($conn, $score_query);
if (!$score_result || mysqli_num_rows($score_result) == 0) {
    die("Error fetching score data or no data found.");
}
$score_data = mysqli_fetch_assoc($score_result);

// Fetch all questions for the exam
$questions_query = "SELECT * FROM question WHERE quiz_id='$eid'";
$questions_result = mysqli_query($conn, $questions_query);
if (!$questions_result) {
    die("Error fetching questions.");
}

// Fetch user's answers for the exam
$user_answers_query = "SELECT * FROM user_answers WHERE user_id='$user_id' AND quiz_id='$eid'";
$user_answers_result = mysqli_query($conn, $user_answers_query);
if (!$user_answers_result) {
    die("Error fetching user answers.");
}

$user_answers = [];
while ($answer = mysqli_fetch_assoc($user_answers_result)) {
    $user_answers[$answer['quiz_id']] = $answer['answer'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Exam Results</title>
</head>
<body>
    <div class="results">
        <h1>Results for Exam</h1>
        <p>Your Score: <?php echo htmlspecialchars($score_data['score']); ?></p>
        <p>Correct Answers: <?php echo htmlspecialchars($score_data['correct_answers']); ?></p>
        <p>Wrong Answers: <?php echo htmlspecialchars($score_data['wrong_answers']); ?></p>
        <h2>Question Details:</h2>
        <?php
        while ($question = mysqli_fetch_assoc($questions_result)) {
            $qid = $question['id'];
            $correct_answer = $question['correct_answer'];
            $user_answer = isset($user_answers[$qid]) ? $user_answers[$qid] : 'Not answered';

            echo '<div class="question-detail">
                    <p>Question: ' . htmlspecialchars($question['question']) . '</p>
                    <p>Your answer: ' . htmlspecialchars($user_answer) . '</p>
                    <p>Correct answer: ' . htmlspecialchars($correct_answer) . '</p>
                </div>';
        }
        ?>
        <a href='quiz_list.php?modules_id=<?php echo $module_id; ?>'>BACK</a>
    </div>
</body>
</html>
