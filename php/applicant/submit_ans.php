<?php
session_start();
if (isset($_POST['submit'])) {
    include_once "../conn_db.php";

    $q_id = $_POST['q_id'];
    $module_id = $_POST['module_id'];
    $answers = $_POST['answers'];
    $user_id = $_SESSION['id'];
    
    // Ensure no previous answers are stored for this exam to avoid duplicate entries
    $delete_previous_answers = "DELETE FROM user_answers WHERE user_id='$user_id' AND quiz_id='$q_id'";
    mysqli_query($conn, $delete_previous_answers);

    $questions_query = "SELECT * FROM question WHERE quiz_id='$q_id'";
    $questions_result = mysqli_query($conn, $questions_query);

    $score = 0;
    $correct_answers = 0;
    $wrong_answers = 0;

    while ($question = mysqli_fetch_assoc($questions_result)) {
        $qid = $question['id'];
        $correct_answer = $question['correct_answer'];
        $marks = $question['marks'];
        $user_answer = isset($answers[$qid]) ? $answers[$qid] : null;

        // Insert the user's answer
        $insert_answer_query = "INSERT INTO user_answers (user_id, quiz_id, question_id, answer) VALUES ('$user_id', '$q_id', '$qid', '$user_answer')";
        mysqli_query($conn, $insert_answer_query);

        if ($user_answer === $correct_answer) {
            $score += $marks;
            $correct_answers++;
        } else {
            $wrong_answers++;
        }
    }

    $currentDate = date("Y-m-d");
    
    // Ensure no previous scores are stored for this exam to avoid duplicate entries
    if ($correct_answers >= 3) {
        // Update the module status to "passed"
        $update_module_status_query = "UPDATE modules SET status='passed' WHERE id='$module_id'";
        mysqli_query($conn, $update_module_status_query);
    }
    
    // Ensure no previous scores are stored for this exam to avoid duplicate entries
    $delete_previous_score = "DELETE FROM user_score WHERE user_id='$user_id' AND quiz_id='$q_id'";
    mysqli_query($conn, $delete_previous_score); 
    // Insert or update the user's score and increment retake count if retaking
    $insert_score_query = "INSERT INTO user_score (user_id, quiz_id, score, correct_answers, wrong_answers, dates) 
                           VALUES ('$user_id', '$q_id', '$score', '$correct_answers', '$wrong_answers', '$currentDate')
                           ON DUPLICATE KEY UPDATE score='$score', correct_answers='$correct_answers', wrong_answers='$wrong_answers', dates='$currentDate'";
    mysqli_query($conn, $insert_score_query);
    
    header("Location: ../../html/applicant/show_res.php?user_id=$user_id&q_id=$q_id&module_id=$module_id");
    exit();
}
?>
