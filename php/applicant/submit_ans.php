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

    // Determine the status based on the score (pass if >= 3 correct, otherwise fail)
    $status = ($correct_answers >= 3) ? 'passed' : 'fail';

    // Check if the record exists
    $check_query = "SELECT * FROM modules_taken WHERE user_id = ? AND module_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ii", $user_id, $module_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Record exists, update it
        $update_query = "UPDATE modules_taken SET status = ?, date_taken = ? WHERE user_id = ? AND module_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssii", $status, $currentDate, $user_id, $module_id);

        if (!$update_stmt->execute()) {
            echo "Error updating modules_taken: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        // Record does not exist, insert it
        $insert_query = "INSERT INTO modules_taken (user_id, module_id, status, date_taken) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("iiss", $user_id, $module_id, $status, $currentDate);

        if (!$insert_stmt->execute()) {
            echo "Error inserting into modules_taken: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    $check_stmt->close();


    // Ensure no previous scores are stored for this exam to avoid duplicate entries
    $delete_previous_score = "DELETE FROM user_score WHERE user_id='$user_id' AND quiz_id='$q_id'";
    mysqli_query($conn, $delete_previous_score); 

    // Insert or update the user's score
    $insert_score_query = "INSERT INTO user_score (user_id, quiz_id, score, correct_answers, wrong_answers, dates) 
                           VALUES ('$user_id', '$q_id', '$score', '$correct_answers', '$wrong_answers', '$currentDate')
                           ON DUPLICATE KEY UPDATE score='$score', correct_answers='$correct_answers', wrong_answers='$wrong_answers', dates='$currentDate'";
    if (!mysqli_query($conn, $insert_score_query)) {
        echo "Error updating user_score: " . mysqli_error($conn);
    }
    
    header("Location: ../../html/applicant/show_res.php?user_id=$user_id&q_id=$q_id&module_id=$module_id");
    exit();
}
?>
