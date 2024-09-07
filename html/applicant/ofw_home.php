<?php
session_start();
$userId = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File a Case</title>
</head>
<body>
    <h2>File a Case</h2>
    <form action="../../php/applicant/submit_case.php" method="POST" enctype="multipart/form-data">
    <input type="number" name="userid" id="userid" value = "<?php echo $userId; ?>" ><br><br>
        <label for="title">Case Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="description">Case Description:</label><br>
        <textarea name="description" id="description" rows="5" required></textarea><br><br>

        <label for="file">Upload Supporting File:</label>
        <input type="file" name="file" id="file"><br><br>

        <button type="submit">Submit Case</button>
    </form>
    <a href="ofw_chat.php">chat with admin</a>
</body>
</html>
