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

// Fetch questions and user answers
$question_sql = "
    SELECT q.id AS question_id, q.question, q.option_a, q.option_b, q.option_c, q.option_d, q.correct_answer, ua.answer 
    FROM question q
    INNER JOIN user_answers ua ON q.id = ua.question_id 
    WHERE ua.answer IS NOT NULL AND ua.answer != ''
    AND ua.user_id = $user_id AND ua.quiz_id = $eid
";

$question_result = $conn->query($question_sql);

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
            <button onclick='window.close()'>Back</button>";
    
        // Loop through the questions
        while ($question_row = $question_result->fetch_assoc()) {
            $question_id = $question_row['question_id'];
            $correct_answer = $question_row['correct_answer']; // Ensure this is fetched correctly from your questions table

            // Display the question and result
            $user_answer = $question_row['answer'];
            $result = ($user_answer == $correct_answer) ? 'Correct' : 'Incorrect';

            echo "<div class='question-result'>";
            echo "<p><strong>Question:</strong> " . htmlspecialchars($question_row['question'] ?? 'N/A') . "</p>";
            echo "<p><strong>Your Answer:</strong> " . htmlspecialchars($user_answer ?? 'N/A') . "</p>";
            echo "<p><strong>Correct Answer:</strong> " . htmlspecialchars($correct_answer ?? 'N/A') . "</p>";
            echo "<p><strong>Result:</strong> " . $result . "</p>";
            echo "<hr>";
            echo "</div>";
        }
    
    } else {
        echo "<p>No score data found.</p>";
    }
    ?>
</body>
</html>
