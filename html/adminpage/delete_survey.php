<?php

    include 'conn_db.php';

        $survey_id = $_GET['survey_id'];

        $sql = "DELETE FROM survey_form WHERE id = '$survey_id'";

            if (mysqli_query($conn, $sql)) {
                // Redirect to the add_question page with parameters
                echo "<script>
                            alert('sure you want to delete this question');
                            window.location.href = 'create_survey.php';
                        </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);

?>