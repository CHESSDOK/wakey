<?php
include '../../php/conn_db.php';

$sql = "SELECT DISTINCT specialization FROM applicant_profile WHERE specialization IS NOT NULL";
$result = $conn->query($sql);

echo "
<table class='table table-borderless' style='background-color: transparent; box-shadow: none;'>
<tr>
<td colspan='3'>
    <input class='form-control' type='text' name='job_title' id='job_title' placeholder='Job Title' required>
</td>
</tr>
<tr>
<td>
    <input class='form-control' type='number' name='vacant' id='vacant' placeholder='Job Vacant' required>
</td>
<td>
    <label for='spe'>Expert Requirement</label>
    <select class='form-select' id='spe' name='spe' required>
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
    <td>
    <input class='form-control' type='text' name='rem' id='rem'  placeholder='Remarks'>
    </td>
</tr>
<tr>
<td>
    <textarea class='form-control' name='job_description' id='job_description'  placeholder='Job Description' required></textarea>
</td>
<td>
    <textarea class='form-control' name='req' id='req'  placeholder='Qualification/Requirements'></textarea>
</td>
<td>
    <input class='form-control' type='text' name='loc' id='loc'  placeholder='Work Location'>
</td>
</tr>
   
 <table>
  <button type='submit' class='btn btn-primary'>Post Job</button>
</form>
";

?>
