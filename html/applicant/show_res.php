<?php
function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: ../login.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}
include_once "../../php/conn_db.php";

$user_id = checkSession();
$eid = $_GET['q_id'];
$module_id = $_GET['module_id'];

$question_sql = "SELECT * FROM question WHERE quiz_id = $eid";
$question_result = $conn->query($question_sql);

$answer_sql = "SELECT answer FROM user_answers WHERE user_id = $user_id AND quiz_id = $eid";
$answer_result = $conn->query($answer_sql);

$score_sql = "SELECT * FROM user_score WHERE user_id = $user_id AND quiz_id = $eid";
$score_result = $conn->query($score_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Exam Results</title>
</head>
<body>
    <?php
    if ($score_result->num_rows > 0) {
        $score_data = $score_result->fetch_assoc();
    
        echo "<div class='results'>
            <h1>Results for Exam</h1>
            <p>Your Score: " . $score_data['score'] . "</p>
            <p>Correct Answers: " . $score_data['correct_answers'] . "</p>
            <p>Wrong Answers: " . $score_data['wrong_answers'] . "</p>
            <h2>Question Details:</h2>
            <button onclick='window.close()'>back</button>";
    
        while ($question_row = $question_result->fetch_assoc()) {
            $correct_answer = $question_row['correct_answer'];
    
            if ($answer_result->num_rows > 0) {
                $user_answer_row = $answer_result->fetch_assoc();
                $user_answer = $user_answer_row['answer'];
            } else {
                $user_answer = 'No answer provided';
            }
    
            $result = ($user_answer == $correct_answer) ? 'Correct' : 'Incorrect';
    
            // Display the question and result
            echo "<p>Question: " . htmlspecialchars($question_row['question'] ?? 'N/A') . "</p>";
            echo "<p>Your Answer: " . htmlspecialchars($user_answer ?? 'N/A') . "</p>";
            echo "<p>Correct Answer: " . htmlspecialchars($correct_answer ?? 'N/A') . "</p>";
            echo "<p>Result: " . $result . "</p>";
        }
    
    } else {
        echo "No score data found.";
    }
    ?>
</body>
</html>
