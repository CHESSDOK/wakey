<?php
include '../../php/conn_db.php';
session_start();
$userId = $_SESSION['id'];

$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

$sql = "SELECT * FROM register WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$res = $stmt->get_result();

if (!$res) {
    die("Invalid query: " . $conn->error); 
}

$row = $res->fetch_assoc();
if (!$row) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Course Page</title>
  <link rel="stylesheet" href="../../css/nav_float.css">
  <link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav>
        <div class="logo">
            <img src="../../img/logo_peso.png" alt="Logo">
            <a href="#"> PESO-lb.ph</a>
        </div>
        <label class="burger" for="burger">
            <input type="checkbox" id="burger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="menu">
            <li><a href="../../index(applicant).php">Home</a></li>
            <li><a href="applicant.php" >Applicant</a></li>
            <li><a href="" class="active">Training</a></li>
            <li><a href="#">OFW</a></li>
            <li><a href="../../html/about.php" >About Us</a></li>
            <li><a href="../../html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
        <button id ="emprof">  <?php echo htmlspecialchars($row['username']); ?> </button>
        </div>
    </nav>
    <header>
        <h1 class="h1">Course List</h1>
    </header>

    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                    <div class="card" style="width: 18rem;">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                        </svg>
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row['course_name']) . '</h5>
                            <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                            <a href="modules_list.php?user_id=' . $userId . '&course_id=' . $row['id'] . '" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                ';
            }
        } else {
            echo '<tr><td colspan="4">No employers found</td></tr>';
        }
        $conn->close();
    ?>

    <script src="../../javascript/script.js"></script> 
</body>
</html>