<?php
include '../../php/conn_db.php';
function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: html/login_employer.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}

$userId = checkSession();
$jobid = $_GET['job_id'];

// SQL JOIN to fetch applicant details and their applications
$sql = "SELECT ap.*, a.* 
        FROM applicant_profile ap
        JOIN applications a ON ap.user_id = a.applicant_id
        WHERE a.job_posting_id = ? AND a.status != 'accepted'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $jobid);
$stmt->execute();
$result = $stmt->get_result();

// Fetch employer profile
$sql = "SELECT * FROM empyers WHERE id = ?";
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
<html>
<head>
    <title>list of applicants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/modal-form.css">
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/employer.css">
</head>
<body>
<!-- Navigation -->
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <header>
        <h1 class="h1">Listed Applicants</h1>
    </header>

    <div class="profile-icons">
        <div class="notif-icon" data-bs-toggle="popover" data-bs-content="#" data-bs-placement="bottom">
            <img id="#" src="../../img/notif.png" alt="Profile Picture" class="rounded-circle">
        </div>
        
        <div class="profile-icon-employer" data-bs-toggle="popover" data-bs-placement="bottom">
          <?php if (!empty($row['photo'])): ?>
              <img id="preview" src="php/employer/images/<?php echo $row['photo']; ?>" alt="Profile Image" class="circular--square">
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
                <tr><td><a href="../../html/employer/employer_home.php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="../../html/employer/job_creat.php" class="nav-link">Post Job</a></td></tr>
                <tr><td><a href="#" class="active nav-link">Job List</a></td></tr>
                <tr><td><a href="../../html/about.php" class="nav-link">About Us</a></td></tr>
                <tr><td><a href="../../html/contact.php" class="nav-link">Contact Us</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../../html/employer/employer_home.php" >Home</a></li>
    <li class="breadcrumb-item"><a href="../../html/employer/job_list.php" >Job List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Applicants</li>
  </ol>
</nav>

    <header>
        <h1 class="h1"></h1>
    </header>
    
    <div class='ep-container'>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Job</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Construct full name
                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];

                echo "
                <tr>
                        <td class='form-label'>" . htmlspecialchars($row["applicant_id"]) . "</td>
                        <td class='form-label'>" . htmlspecialchars($full_name) . "</td>
                        <td class='form-label'>" . htmlspecialchars($row["job"]) . "</td>
                        <td><a href='../../php/employer/application_process.php?id=" . $row['user_id'] . "'>accepted</a></td>
                        <td><button id='openFormBtn' 
                                    data-applicant-id=" . htmlspecialchars($row["applicant_id"]) ." 
                                    data-job-id=" . htmlspecialchars($row["job_posting_id"]) .">interview</button></td>
                        <td><button id='profileFormBtn'  class='openProfileBtn'
                                    data-applicant-id='" . htmlspecialchars($row["applicant_id"]) . "'>view profile</button></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No applicants found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>


    <div id="formModal" class="modal">
        <div class="modal-content">
            <span class="closeBtn">&times;</span>
            <h2>Interview</h2>
            <form action="../../php/employer/interview.php" method="post">
                <input type="hidden" id="applicantId" name="applicant_id">
                <input type="hidden" id="jobid" name="jobid">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br><br>
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required><br><br>
                <label for="interview">Interview Type:</label>
                <select name="interview" id="interview">
                    <option value="online">Online</option>
                    <option value="FacetoFace">Face to Face</option>
                </select>
                <label for="link">Link:</label>
                <input type="text" id="link" name="link"><br><br>
                <label for="address">Physical Address:</label>
                <input type="text" id="address" name="address"><br><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

<!-- Modal for Viewing Applicant Profile -->
<div id="profileModal" class="modal">
    <div class="modal-content">
        <span class="closeBtn">&times;</span>
        <h2>Applicant Profile</h2>
        <div id="applicantProfileContent">
            <!-- Profile details will be dynamically loaded here -->
        </div>
    </div>
</div>

    <script src="../../javascript/popup-modal.js"></script>
    <script>
    const today = new Date();
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0
    const yyyy = today.getFullYear();
    const currentDate = `${yyyy}-${mm}-${dd}`;

    // Set the min attribute to today's date
    document.getElementById('date').setAttribute('min', currentDate);
    </script>

    <script src="../../javascript/script.js"></script>
</body>
</html>
