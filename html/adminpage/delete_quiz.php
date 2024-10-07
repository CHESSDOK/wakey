<?php
    include 'conn_db.php';

    $modules_id = $_GET['module_id'];
    $id = $_GET['id'];
    $course_id = $_GET['course_id'];

        // Delete the quiz
        $sql = "DELETE FROM quiz_name WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            // Delete associated questions
            $sql_new = "DELETE FROM question WHERE quiz_id = '$id'";
            mysqli_query($conn, $sql_new);

            echo "<script>
                    alert('Quiz deleted successfully.');
                    window.location.href = 'quiz_list.php?modules_id=$modules_id&course_id=$course_id';
                  </script>";
        }

    mysqli_close($conn);
?>
