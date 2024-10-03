<?php

    include 'conn_db.php';

        $course_id = $_GET['course_id'];
        $module_id = $_GET['module_id'];

        $sql = "DELETE FROM modules WHERE id = '$module_id'";

            if (mysqli_query($conn, $sql)) {
                // Redirect to the add_question page with parameters
                echo "<script>
                            alert('sure you want to delete this module');
                            window.location.href = 'module_list.php?course_id=".$course_id."&modules_id=".$modules_id."';
                        </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

?>