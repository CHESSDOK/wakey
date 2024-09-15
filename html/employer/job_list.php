<?php
include '../../php/conn_db.php';
function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
    checkSession();    header("Location: ../../html/employer/employer_login.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}
$employerid = checkSession();

$sql = "SELECT * FROM job_postings WHERE employer_id = $employerid ";
$result = $conn->query($sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>job posted</h1>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>job description</th>
            <th>specialization</th>
            <th> vacant </th>
            <th>status</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <form action='../../php/employer/update_jobs.php' method='post'>
                            <input type='hidden' name='job_id' value='" . $row['j_id'] . "'>
                            <td><input type='text' name='jtitle' value='" . $row['job_title'] . "'></td>
                            <td><input type='text' name='desc' value='" . $row['job_description'] . "'></td>
                            <td><input type='text' name='spe' value='" . $row['specialization'] . "'></td>
                            <td><input type='number' name='vacant' value='" . $row['vacant'] . "'></td>
                            <td><input type='number' name='act' value='" . $row['is_active'] . "'></td>
                            <td><input type='submit' value='update'></td>
                            </form>
                            <td><a href='applicant_list.php?job_id=" . $row['j_id']  ."'>applicant list</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No employers found</td></tr>";
            }
            $conn->close();
        ?>
    </table>

    <a href="nav_employer.php">back</a>
</body>
</html>