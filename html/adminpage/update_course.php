<?php

    include 'conn_db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $course_id = $_POST['course_id'];
        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];

        $sql = "UPDATE `courses` 
            SET course_name = '$course_name', description = '$course_desc' 
            WHERE id = '$course_id'";

            if (mysqli_query($conn, $sql)) {
                // Redirect to the add_question page with parameters
                echo "<script>
                            alert(' succesfully updated!');
                            window.location.href = 'course_list.php';
                        </script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

    }
?>