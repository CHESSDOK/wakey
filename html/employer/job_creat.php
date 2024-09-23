<?php
session_start();
include '../../php/conn_db.php';
// Assuming you have a session variable that holds the user type
if (!isset($_SESSION['username'])) {
    header("Location: login_employer.html");
    exit();
}

$sql = "SELECT * FROM applicant_profile";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link rel="stylesheet" href="../css/nav_float.css">
</head>
<style>
body::before{
    background-image:none;
    background-color:#EBEEF1;
    }
</style>
<body>

    <header>
        <h1 class="h1">Employer Dashboard</h1>
    </header>

    <form action="../../php/employer/post_job_process.php" method="post">
        <label for="job_title">Job Title:</label>
        <input type="text" name="job_title" id="job_title" required><br>
        <label for="vacant">Job vacant:</label>
        <input type="num" name="vacant" id="vacant" required><br>
        <div class="Specialization">
                <label for="sex">Expert Requirement</label>
                    <select id="spe" name="spe">
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['specialization']."'>".$row['specialization']."</option>";
                            }
                        }
                        $conn->close();   
                    ?>
                    </select>

            </div>
        <label for="job_description">Job Description:</label>
        <textarea name="job_description" id="job_description" required></textarea><br>
        <label for="Q/R">Qualification/Requirements</label>
        <textarea name="req" id="req" ></textarea> <br>
        <label for="WL">Work Location</label>
        <input type="text" name="loc" id="loc"> <br>
        <label for="">Remarks</label>
        <input type="text" name="rem" id="rem"><br>


        <input type="submit" value="Post Job">
    </form>

    <!-- Body -->

    

   <script src="../javascript/script.js"></script> <!-- You can link your JavaScript file here if needed -->
</body>
</html>
