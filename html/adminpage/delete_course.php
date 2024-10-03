<?php

    include 'conn_db.php';

        $course_id = $_GET['course_id'];

        $sql = "DELETE FROM courses WHERE id = '$course_id'";

            if (mysqli_query($conn, $sql)) {
                // Redirect to the add_question page with parameters
                echo "<script>
                            alert('sure you want to delete this course');
                            window.location.href = 'course_list.php';
                        </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

?>