<?php
    include 'conn_db.php';

    $modules_id = $_GET['modules_id'];
    $id = $_GET['id'];
    $course_id = $_GET['course_id'];

    // Confirmation before proceeding with deletion
    echo "<script>
            if(confirm('Are you sure you want to delete this quiz?')) {
                window.location.href = 'delete_quiz.php?id=$id&confirm=true';
            } else {
                window.location.href = 'quiz_list.php';
            }
          </script>";

    // Proceed with deletion if confirmed
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
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
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>
