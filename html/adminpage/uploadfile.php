<?php
$modules_id = $_GET['modules_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mod_id" value="<?php echo htmlspecialchars($modules_id); ?>">
    <label for="des">Description:</label>
    <input type="text" name="desc" id="desc" > <br>
    <label for="files">Select files:</label>
    <input type="file" name="files[]" id="files" multiple> <br>
    <label for="link">Video:</label>
    <input type="url" name="link" id="link" >
    <input type="submit" name="submit" value="Upload">
</form>

</body>
</html>
