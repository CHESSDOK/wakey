<?php
include '../../php/conn_db.php';
if(isset($_POST['gen'])){

    $name = ucwords(strtolower($_POST['name']));
    $total = $_POST['total'];
    $corr = $_POST['corr'];
    $wrong = $_POST['wrong'];
    $tag = $_POST['tag'];
    $id = $_POST['module_id'];

    // Insert the data into the exam table
    $sql = "INSERT INTO quiz_name(module_id, title, correct_ans, wrong_ans, total, tag, date) VALUES ('$id', '$name', '$corr', '$wrong', '$total', '$tag', NOW())";

    if (mysqli_query($conn, $sql)) {

        // Get the last inserted ID
        $last_id = mysqli_insert_id($conn);

        // Redirect to question entry page with the last exam ID and total questions
        header("Location: questions.php?q_id=$last_id&total=$total&module_id=$id");
        exit();

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>
