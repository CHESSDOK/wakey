<div class="container input-group"  class="">
    <form action="../../php/applicant/submit_case.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <label class="info" for="title">Case Title:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control"  type="text" name="title" id="title" required>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                      <textarea class="form-control text-comment" placeholder="" id="floatingTextarea"></textarea>
                      <label for="floatingTextarea">Case Description:</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="info" for="file">Upload Supporting File:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control"  type="file" name="file" id="file">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Submit Case</button>
                </td>
            </tr>
        </table>
    </form>
</div>


<table border="1">
    <tr>
        <th>Question</th>
        <th>Never</th>
        <th>Often</th>
        <th>Sometimes</th>
        <th>Always</th>
    </tr>
    <form action='../../php/applicant/survey_reponse.php' method='POST'>
<?php
    $sql = "SELECT * FROM survey_form";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Fetch the user's previous response for the current survey question
            $survey_id = $row['id'];
            $response_sql = "SELECT reponse FROM survey_reponse WHERE user_id = $userId AND survey_id = $survey_id";
            $response_result = $conn->query($response_sql);
            $previous_response = '';

            if ($response_result->num_rows > 0) {
                $response_row = $response_result->fetch_assoc();
                $previous_response = $response_row['reponse'];  // Get the previous response if it exists
            }

            echo "<tr>
                    <td>". $row["question"] . "</td>
                    <input type='hidden' name='survey_ids[]' value='".$row['id']."'>
                    <input type='hidden' name='user_id' value='".$userId."'>
                    <td> <input type='radio' name='response".$row['id']."' value='Never' " . ($previous_response == 'Never' ? 'checked' : '') . "></td>
                    <td> <input type='radio' name='response".$row['id']."' value='Often' " . ($previous_response == 'Often' ? 'checked' : '') . "></td>
                    <td> <input type='radio' name='response".$row['id']."' value='Sometimes' " . ($previous_response == 'Sometimes' ? 'checked' : '') . "></td>
                    <td><input type='radio' name='response".$row['id']."' value='Always' " . ($previous_response == 'Always' ? 'checked' : '') . "></td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No questions found</td></tr>";
    }

    $conn->close();
?>
    <tr>
        <td></td>
        <td></td>
        <td><input type="submit" value="Submit"></td>
        <td></td>
    </tr>
    </form>
</table>
