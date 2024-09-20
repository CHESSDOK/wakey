<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survey Form</title>
</head>
<body>
<table border="1">
    <tr>
        <th>question</th>
        <th>response</th>
    </tr>
    <?php
    include 'conn_db.php';
    $userid = $_GET['user_id'];
    // Fetch unique user response data (grouped by user_id)
    $sql_new1 = "SELECT survey_reponse.survey_id,
                        survey_reponse.reponse, 
                        survey_form.question
                 FROM survey_reponse
                 INNER JOIN survey_form ON survey_reponse.survey_id = survey_form.id
                 WHERE survey_reponse.user_id = $userid
                 ";

    $result_new = $conn->query($sql_new1);

    if ($result_new->num_rows > 0) {
        while ($row = $result_new->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['question'] . "</td>
                    <td>" . $row['reponse'] . "</td>
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
