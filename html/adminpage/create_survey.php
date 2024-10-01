<?php
include 'conn_db.php';  // Database connection

// Insert survey question
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questions = $_POST['question'];

    // Prepared statement for security
    $stmt = $conn->prepare("INSERT INTO survey_form (question) VALUES (?)");
    $stmt->bind_param("s", $questions);

    if ($stmt->execute() === TRUE) {
        header("Location: create_survey.php");
        exit();  // Important to stop further script execution after redirect
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch existing survey questions
$sql_new = "SELECT * FROM survey_form";
$result = $conn->query($sql_new);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/modal-form.css">
    <title>Document</title>
</head>
<body>
    <form action="create_survey.php" method="POST">
        <label for="question">Survey Question</label>
        <input type="text" name="question" value="Enter survey Questions">
        <input type="submit" value="submit">
    </form>

    <table border="1">
        <tr>
            <th>Form ID</th>
            <th>Question</th>
            <th></th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <form action='update_survey.php' method='POST'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <td>" . $row["id"] . "</td>
                        <td><input type='text' name='question' value='" . $row["question"] . "'></td>
                        <td><input type='submit' value='update'></td>
                        </form>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No survey found</td></tr>";
        }
        ?>

    </table>
<!-- ####################################################### ANTHOTER TABLE ###################################################################### -->
<table border="1">
    <tr>
        <th>User ID</th>
        <th>Full Name</th>
    </tr>
    <?php
    // Fetch unique user response data (grouped by user_id)
    $sql_new1 = "SELECT survey_reponse.user_id, 
                    MAX(applicant_profile.first_name) AS first_name, 
                    MAX(applicant_profile.middle_name) AS middle_name, 
                    MAX(applicant_profile.last_name) AS last_name
             FROM survey_reponse
             INNER JOIN applicant_profile ON survey_reponse.user_id = applicant_profile.user_id
             GROUP BY survey_reponse.user_id";
              // Ensures only unique user_id

    $result_new = $conn->query($sql_new1);

    if ($result_new->num_rows > 0) {
        while ($row = $result_new->fetch_assoc()) {
            $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
            echo "<tr>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $full_name . "</td>
                    <td> <a class='docu openSurveyBtn' href='#' data-user-id=".htmlspecialchars($row['user_id'])."> check </a> </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No users found</td></tr>";
    }

    // Close connection at the very end of the script
    $conn->close();
    ?>
</table>

<!-- employer list -->
<div id="surveyModal" class="modal">
            <div class="modal-content">
                <span class="closeBtn">&times;</span>
                <div id="surveyModuleContent">
                    <!-- Module content will be dynamically loaded here -->
                </div>
            </div>
        </div>


    <script>  const surveyModal = document.getElementById('surveyModal');
        const closeModuleBtn = document.querySelector('.closeBtn');
        // Open profile modal and load data via AJAX
        $(document).on('click', '.openSurveyBtn', function(e) {
            e.preventDefault();
            const userId = $(this).data('user-id');

            $.ajax({
                url: 'user_response.php',
                method: 'GET',
                data: { user_id: userId },
                success: function(response) {
                    $('#surveyModuleContent').html(response);
                    surveyModal.style.display = 'flex';
                }
            });
        });

        // Close profile modal when 'x' is clicked
        closeModuleBtn.addEventListener('click', function() {
            surveyModal.style.display = 'none';
        });

        // Close profile modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === surveyModal) {
                surveyModal.style.display = 'none';
            }
        });
    </script>


</body>
</html>
