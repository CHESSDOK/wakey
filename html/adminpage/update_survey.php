<?php
include 'conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $question = $_POST['question'];
    $category = $_POST['category'];

    // Update the data in the quiz_name table
    $sql = "UPDATE `survey_form` 
            SET question = '$question', category = '$category' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the add_question page with parameters
        header("Location: create_survey.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
