<?php
include '../../php/conn_db.php';

function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: login_employer.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}

$userId = checkSession();
$sql = "SELECT * FROM employer_profile WHERE user_id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the data as an associative array
    $row = $result->fetch_assoc();
} else {
    echo "No data found for this user.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <form action="../../php/employer/employer_prof_process.php" method="post">
        <div id="companyField">
            <label for="company_name">ID:</label>

            <label for="profile_image">Select Profile Image:</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*" required> <br>

            <label for="company_name">Company Name:</label>
            <input type="text" name="company_name" id="company_name" value="<?php echo htmlspecialchars($row['company_name'] ?? ''); ?>"><br>

            <label for="company_add">Company Address:</label>
            <input type="text" name="company_add" id="company_add" value="<?php echo htmlspecialchars($row['company_address'] ?? ''); ?>"><br>

            <label for="tel_num">Company Telephone Number:</label>
            <input type="text" name="tel_num" id="tel_num" value="<?php echo htmlspecialchars($row['tel_num'] ?? ''); ?>"><br>

            <label for="president">Company President:</label>
            <input type="text" name="president" id="president" value="<?php echo htmlspecialchars($row['president'] ?? ''); ?>"><br>

            <label for="HR">HR Manager:</label>
            <input type="text" name="HR" id="HR" value="<?php echo htmlspecialchars($row['HR'] ?? ''); ?>"><br>

            <label for="company_mail">Company Email:</label>
            <input type="text" name="company_mail" id="company_mail" value="<?php echo htmlspecialchars($row['company_mail'] ?? ''); ?>"><br>

            <label for="HR_mail">HR Official Email:</label>
            <input type="text" name="HR_mail" id="HR_mail" value="<?php echo htmlspecialchars($row['HR_mail'] ?? ''); ?>"><br>
        </div>

        <input type="submit" value="Update">
    </form>
</body>
</html>