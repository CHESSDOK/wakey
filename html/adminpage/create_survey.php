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
                    <td> <a href='user_response.php?user_id=".$row['user_id']."'> check </a> </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No users found</td></tr>";
    }

    // Close connection at the very end of the script
    $conn->close();
    ?>
</table>

</body>
</html>
