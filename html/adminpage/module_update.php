<?php

    include 'conn_db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $course_id = $_POST['course_id'];
        $module_id = $_POST['module_id'];
        $module_name = $_POST['module_name'];

        $sql = "UPDATE `modules` 
            SET module_name = '$module_name'
            WHERE id = '$module_id'";

            if (mysqli_query($conn, $sql)) {
                // Redirect to the add_question page with parameters
                echo "<script>
                            alert(' succesfully updated!');
                            window.location.href = 'module_list.php?course_id=$course_id&module_id=$module_id';
                        </script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

    }
?>