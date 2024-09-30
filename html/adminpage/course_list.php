<?php
include 'conn_db.php';
session_start();
$admin = $_SESSION['username'];
// Fetch all employers
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - course List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/modal-form.css">
    <link rel="stylesheet" href="../../css/admin_course.css">
    <link rel="stylesheet" href="../../css/nav_float.css">

</head>
<body>

<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <header>
      <h1 class="ofw-h1">Course List</h1>
    </header>

    <div class="profile-icons">
        <div class="notif-icon" data-bs-toggle="popover" data-bs-content="#" data-bs-placement="bottom">
            <img id="#" src="../../img/notif.png" alt="Profile Picture" class="rounded-circle">
        </div>
        
        <div class="profile-icon" data-bs-toggle="popover" data-bs-placement="bottom">
    <?php if (!empty($row['photo'])): ?>
        <img id="preview" src="php/applicant/images/<?php echo $row['photo']; ?>" alt="Profile Image" class="circular--square">
    <?php else: ?>
        <img src="../../img/user-placeholder.png" alt="Profile Picture" class="rounded-circle">
    <?php endif; ?>
    </div>

    </div>

    <!-- Burger icon -->
    <div class="burger" id="burgerToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
</td>
</tr>
</table>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table class="menu">
                <tr><td><a href="admin_home.php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="employer_list.php" class="nav-link">Employer List</a></td></tr>
                <tr><td><a href="#" class="active nav-link">Course List</a></td></tr>
                <tr><td><a href="ofw_case.php" class="nav-link">OFW Cases</a></td></tr>
                <tr><td><a href="create_survey.php" class="nav-link">OFW Survey</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin_home.php" >Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Courses</li>
  </ol>
</nav>

<div class="table-container">
    <table class="table table-borderless table-hover">
        <tr>
            <th>Course</th>
            <th>Course Description</th>
            <th>Module Label</th>
            <th>Module Items</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["course_name"] . "</td>
                        <td>" . $row["description"] . "</td>
                        <td><a href='#' id='moduleBtn'  class='openModuleBtn'
                                    data-module-id='" . htmlspecialchars($row["id"]) . "'>Edit Label</a></td>
                        <td><a class='docu' href='module_list.php?module_id=" . $row["id"] . "'>Edit Items</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>


    
<!-- Modal for Viewing Applicant Profile -->
<div id="moduleModal" class="modal">
    <div class="modal-content">
        <span class="closeBtn">&times;</span>
        <h2>Applicant Profile</h2>
        <div id="uploadModuleContent">
            <!-- Profile details will be dynamically loaded here -->
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../javascript/admin_modal.js"></script>
    <script src="../../javascript/a_profile.js"></script> 
    <script src="../../javascript/script.js"></script> 

    <script>

    </script>
</body>
</html>
