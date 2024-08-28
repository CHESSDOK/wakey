<?php
session_start();

// Assuming you have a session variable that holds the user type
if (!isset($_SESSION['username'])) {
    header("Location: login_employer.html");
    exit();
}
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

        <label for="job_description">Job Description:</label>
        <textarea name="job_description" id="job_description" required></textarea><br>

        <input type="submit" value="Post Job">
    </form>

    <!-- Body -->

    

   <script src="../javascript/script.js"></script> <!-- You can link your JavaScript file here if needed -->
</body>
</html>
