<?php
include 'conn_db.php';
$userid = $_GET['user_id'];
$sql_new1 = "SELECT survey_reponse.survey_id,
                        survey_reponse.reponse, 
                        survey_form.question
                 FROM survey_reponse
                 INNER JOIN survey_form ON survey_reponse.survey_id = survey_form.id
                 WHERE survey_reponse.user_id = $userid
                 ";


$result_new = $conn->query($sql_new1);

echo "
        <h1> User survey reponses </h1>
        <table border='1'>
    <tr>
        <th>question</th>
        <th>response</th>
    </tr>

     ";

if ($result_new->num_rows > 0) {
    while ($row = $result_new->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['question'] . "</td>
                <td>" . $row['reponse'] . "</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='2'>No users found</td></tr> </table>";
}

// Close connection at the very end of the script
$conn->close();
?>