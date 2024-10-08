<?php
include '../../php/conn_db.php';

$sql = "SELECT DISTINCT specialization FROM applicant_profile WHERE specialization IS NOT NULL";
$result = $conn->query($sql);

echo "
<form method='post' action='your_action_url_here'> <!-- Specify your action URL -->
    <table class='table table-borderless' style='background-color: transparent; box-shadow: none;'>
        <tr>
            <td>
                <input class='form-control' type='text' name='job_title' id='job_title' placeholder='Job Title' required>
            </td>
            <td>
                <input class='form-control custom-input-size mt-1' type='number' name='vacant' id='vacant' placeholder='Job Vacant' required>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <textarea class='form-control' name='rem' id='rem' placeholder='Remarks'></textarea>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <label for='spe'>Expert Requirement</label>
                <select class='form-select custom-input-size' id='spe' name='spe' required>
                    <option value=''>Select a specialization</option>";

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['specialization']) . "'>" . htmlspecialchars($row['specialization']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No specialization found</option>";
                    }

echo "
                </select>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <textarea class='form-control' name='job_description' id='job_description' placeholder='Job Description' required></textarea>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <textarea class='form-control' name='req' id='req' placeholder='Qualification/Requirements'></textarea>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <input class='form-control' type='text' name='loc' id='loc' placeholder='Work Location'>
            </td>
        </tr>
      </table>
    <button type='submit' class='btn btn-primary'>Post Job</button>
</form>
";


?>
