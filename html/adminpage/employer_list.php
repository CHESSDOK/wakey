<?php
include 'conn_db.php';
session_start();
$admin = $_SESSION['username'];
// Fetch all employers
$sql = "SELECT * FROM empyers";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Employer List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/modal-form.css">
    <link rel="stylesheet" href="../../css/admin_employer.css">
    <link rel="stylesheet" href="../../css/nav_float.css">

</head>
<body>
<!-- Navigation -->
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <header>
      <h1 class="ofw-h1">Employer List</h1>
    </header>

    <div class="profile-icons">
        <div class="notif-icon" data-bs-toggle="popover" data-bs-content="#" data-bs-placement="bottom">
            <img id="#" src="../../img/notif.png" alt="Profile Picture" class="rounded-circle">
        </div>
        
        <div class="profile-icon" data-bs-toggle="popover" data-bs-placement="bottom">
    <?php if (!empty($row['photo'])): ?>
        <img id="preview" src="../../php/applicant/images/<?php echo $row['photo']; ?>" alt="Profile Image" class="circular--square">
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

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table class="menu">
            <tr><td><a href="admin_home.php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="#" class="active nav-link">Employer List</a></td></tr>
                <tr><td><a href="course_list.php" class="nav-link">Course List</a></td></tr>
                <tr><td><a href="ofw_case.php" class="nav-link">OFW Cases</a></td></tr>
                <tr><td><a href="user_master_list.php" class="nav-link">user list</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin_home.php" >Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Employer List</li>
  </ol>
</nav>

<div class="table-container">
    <table class="table table-borderless table-hover"> <!-- Add Bootstrap table class -->
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Documents</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td><a class='docu openEmployersBtn' href='#' data-employer-id=".htmlspecialchars($row['id']).">View Documents</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No employers found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- employer list -->
<div id="employerModal" class="modal modal-container">
    <div class="modal-content">
        <span class="btn-close closBtn closeBtn ">&times;</span>
        <div id="employersModuleContent">
            <!-- Module content will be dynamically loaded here -->
        </div>
    </div>
</div>

    <script>  const employerModal = document.getElementById('employerModal');
        const closeModuleBtn = document.querySelector('.closBtn');
        // Open profile modal and load data via AJAX
        $(document).on('click', '.openEmployersBtn', function(e) {
            e.preventDefault();
            const employerId = $(this).data('employer-id');

            $.ajax({
                url: 'employer_docs_list.php',
                method: 'GET',
                data: { employer_id: employerId },
                success: function(response) {
                    $('#employersModuleContent').html(response);
                    employerModal.style.display = 'flex';
                }
            });
        });

        // Close profile modal when 'x' is clicked
        closeModuleBtn.addEventListener('click', function() {
            employerModal.style.display = 'none';
        });

        // Close profile modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === employerModal) {
                employerModal.style.display = 'none';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/a_profile.js"></script>
    <script src="../../javascript/script.js"></script> 
</body>
</html>
