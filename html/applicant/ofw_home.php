<?php
include '../../php/conn_db.php';

function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: ../login.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}
$userId = checkSession();

// Fetch data from applicant_profile table
$sql = "SELECT * FROM applicant_profile WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Invalid query: " . $conn->error); 
}

$row = $result->fetch_assoc();
if (!$row) {
    die("User not found in applicant_profile.");
}

// Fetch data from register table using new approach
$sql_new = "SELECT * FROM register WHERE id = ?";
$stmt_new = $conn->prepare($sql_new);
$stmt_new->bind_param("i", $userId);
$stmt_new->execute();
$result_new = $stmt_new->get_result();

if ($result_new->num_rows > 0) {
    $row_new = $result_new->fetch_assoc(); // Fetch the data into a separate variable
} else {
    $row_new = array(); // If no data found, initialize as an empty array
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Submission</title>
  
  <link rel="stylesheet" href="../../css/ofw_home.css">
  <link rel="stylesheet" href="../../css/nav_float.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body data-bs-spy="scroll" data-bs-target="#scrollspy-menu" data-bs-offset="10" tabindex="0">

 <!-- Navigation -->
 <nav class="ofw-nav">
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
            <li><a href="applicant.php">Applicant</a></li>
            <li><a href="training_list.php">Training</a></li>
            <li><a href="#" class="active">OFW</a></li>
            <li><a href="../../html/about.php" >About Us</a></li>
            <li><a href="../../html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
          <button class="ofw-btn" id="emprof"><?php echo htmlspecialchars($row_new['username']); ?></button>
        </div>
    </nav>
  
    <header>
        <h1 class="ofw-h1">File a Case</h1>
    </header>


    <div class="outer-container">
  <div class="container-fluid" data-bs-spy="scroll" data-bs-target="#scrollspy-menu" data-bs-offset="10" tabindex="0">
    <!-- Scrollspy Menu -->
    <nav id="scrollspy-menu" class="scrollspy flex-column nav-pills">
      <a class="nav-link" href="#section1">Personal Information</a>
      <a class="nav-link" href="#section2">Applicant information</a>
      <a class="nav-link" href="#section3">Learners Information</a>
      <a class="nav-link" href="#section4">OFW Information</a>
    </nav>

    <!-- Form Content -->
    <div class="form-content">
      <form action="../../php/applicant/of.php" method="POST">
        
        <!-- Personal Information -->
        <div id="section1" class="input-group">
          <h4>Personal Information</h4>
          <table>
            <tr>
              <td>
                <label for="firstName" class="info">First Name</label>
                <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo isset($row['first_name']) ? htmlspecialchars($row['first_name']) : ''; ?>" required>
              </td>
              <td>
                <label for="middleName" class="info">Middle Name</label>
                <input type="text" id="middleName" name="middleName" class="form-control" value="<?php echo isset($row['middle_name']) ? htmlspecialchars($row['middle_name']) : ''; ?>" >
              </td>
              <td>
                <label for="lastName" class="info">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo isset($row['last_name']) ? htmlspecialchars($row['last_name']) : ''; ?>" required>
              </td>
            </tr>
            <tr>
              <td>
                <label for="age" class="info">Age</label>
                <input type="number" id="age" name="age" class="form-control" value="<?php echo isset($row['age']) ? htmlspecialchars($row['age']) : ''; ?>" required>
              </td>
              <td>
                <label for="dob" class="info">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" value="<?php echo isset($row['dob']) ? htmlspecialchars($row['dob']) : ''; ?>" required>
              </td>
              <td>
                <label for="contactNo" class="info">Contact No.</label>
                <input type="tel" id="contactNo" name="contactNo" class="form-control" value="<?php echo isset($row['contact_no']) ? htmlspecialchars($row['contact_no']) : ''; ?>" required>
              </td>
            </tr>
            <tr>
              <td>
                <label for="sex" class="info">Sex</label>
                <select id="sex" name="sex" class="form-control" required>
                  <option value="Male" <?php echo (isset($row['sex']) && $row['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo (isset($row['sex']) && $row['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                </select>
              </td>
              <td>
                <label for="civilStatus" class="info">Civil Status</label>
                <select id="civilStatus" name="civilStatus" class="form-control" required>
                  <option value="Single" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                  <option value="Married" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                  <option value="Widowed" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                  <option value="Separated" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Separated') ? 'selected' : ''; ?>>Separated</option>
                </select>
              </td>
              <td>
                <label for="email" class="info">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>" required>
              </td>
            </tr>
            <tr>
                <td>
                    <label for="houseNo" class="info">House No.</label>
                    <input type="text" id="houseNo" name="houseNo" class="form-control" value="<?php echo isset($row['house_no']) ? htmlspecialchars($row['house_no']) : ''; ?>" required>
                </td>
                <td>
                    <label for="subdivision" class="info">Subdivision</label>
                    <input type="text" id="subdivision" name="subdivision" class="form-control" value="<?php echo isset($row['subdivision']) ? htmlspecialchars($row['subdivision']) : ''; ?>">
                </td>
                <td>
                    <label for="barangay" class="info">Barangay</label>
                    <input type="text" id="barangay" name="barangay" class="form-control" value="<?php echo isset($row['barangay']) ? htmlspecialchars($row['barangay']) : ''; ?>" required>
                </td>
              </tr>
              <tr>
                <td>
                    <label for="city" class="info">City/Municipality</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php echo isset($row['city']) ? htmlspecialchars($row['city']) : ''; ?>" required>
                </td>
                <td>
                    <label for="province" class="info">Province</label>
                    <input type="text" id="province" name="province" class="form-control" value="<?php echo isset($row['province']) ? htmlspecialchars($row['province']) : ''; ?>" required>
                </td>
                <td>
                    <label for="sssNo" class="info">SSS No.</label>
                    <input type="text" id="sssNo" name="sssNo" class="form-control" value="<?php echo isset($row['sss_no']) ? htmlspecialchars($row['sss_no']) : ''; ?>">
                </td>
              </tr>
              <tr>
                <td>
                    <label for="pagibigNo" class="info">Pag-IBIG No.</label>
                    <input type="text" id="pagibigNo" name="pagibigNo" class="form-control" value="<?php echo isset($row['pagibig_no']) ? htmlspecialchars($row['pagibig_no']) : ''; ?>">
                </td>
                <td>
                    <label for="philhealthNo" class="info">PhilHealth No.</label>
                    <input type="text" id="philhealthNo" name="philhealthNo" class="form-control" value="<?php echo isset($row['philhealth_no']) ? htmlspecialchars($row['philhealth_no']) : ''; ?>">
                </td>
                <td>
                    <label for="passportNo" class="info">Passport No.</label>
                    <input type="text" id="passportNo" name="passportNo" class="form-control" value="<?php echo isset($row['passport_no']) ? htmlspecialchars($row['passport_no']) : ''; ?>">
                </td>
              </tr>
              <tr>
                <td>
                    <label for="immigrationStatus" class="info">Immigration Status</label>
                    <select id="immigrationStatus" name="immigrationStatus" class="form-control" required>
                        <option value="Documented" <?php echo (isset($row['immigration_status']) && $row['immigration_status'] == 'Documented') ? 'selected' : ''; ?>>Documented</option>
                        <option value="Undocumented" <?php echo (isset($row['immigration_status']) && $row['immigration_status'] == 'Undocumented') ? 'selected' : ''; ?>>Undocumented</option>
                        <option value="Returning" <?php echo (isset($row['immigration_status']) && $row['immigration_status'] == 'Returning') ? 'selected' : ''; ?>>Returning</option>
                        <option value="Repatriated" <?php echo (isset($row['immigration_status']) && $row['immigration_status'] == 'Repatriated') ? 'selected' : ''; ?>>Repatriated</option>
                    </select>
                </td>
                <td>
                    <!-- Empty cell -->
                </td>
                <td>
                    <!-- Empty cell -->
                </td>
              </tr>
          </table>
        </div>

        <!-- Family Information -->
        <div id="section2" class="input-group">
          <h4>Family Information</h4>
          <table>
            <tr>
              <td>
                <label for="spouseName" class="info">Spouse's Name</label>
                <input type="text" id="spouseName" name="spouseName" class="form-control" value="<?php echo isset($row['spouse_name']) ? htmlspecialchars($row['spouse_name']) : ''; ?>">
              </td>
              <td>
                <label for="spouseContact" class="info">Spouse's Contact No.</label>
                <input type="text" id="spouseContact" name="spouseContact" class="form-control" value="<?php echo isset($row['spouse_contact']) ? htmlspecialchars($row['spouse_contact']) : ''; ?>">
              </td>
              <td>
                <label for="fathersName" class="info">Father's Name</label>
                <input type="text" id="fathersName" name="fathersName" class="form-control" value="<?php echo isset($row['fathers_name']) ? htmlspecialchars($row['fathers_name']) : ''; ?>">
              </td>
            </tr>
            <tr>
              <td>
                <label for="fathersAddress" class="info">Father's Address</label>
                <input type="text" id="fathersAddress" name="fathersAddress" class="form-control" value="<?php echo isset($row['fathers_address']) ? htmlspecialchars($row['fathers_address']) : ''; ?>">
              </td>
              <td>
                <label for="mothersName" class="info">Mother's Name</label>
                <input type="text" id="mothersName" name="mothersName" class="form-control" value="<?php echo isset($row['mothers_name']) ? htmlspecialchars($row['mothers_name']) : ''; ?>">
              </td>
              <td>
                <label for="mothersAddress" class="info">Mother's Address</label>
                <input type="text" id="mothersAddress" name="mothersAddress" class="form-control" value="<?php echo isset($row['mothers_address']) ? htmlspecialchars($row['mothers_address']) : ''; ?>">
              </td>
            </tr>
              <tr>
                  <td>
                      <label for="emergency-contact" class="info">In Case of Emergency, Contact Person</label>
                      <input type="text" id="emergency-contact" name="emergency_contact" class="form-control" placeholder="Contact Person" value="<?php echo isset($row['emergency_contact']) ? htmlspecialchars($row['emergency_contact']) : ''; ?>">
                  </td>
                  <td>
                      <label for="next-of-kin-relationship" class="info">Relationship to Next of Kin</label>
                      <input type="text" id="next-of-kin-relationship" name="next_of_kin_relationship" class="form-control" placeholder="Relationship" value="<?php echo isset($row['next_of_kin_relationship']) ? htmlspecialchars($row['next_of_kin_relationship']) : ''; ?>">
                  </td>
                  <td>
                      <label for="next-of-kin-contact" class="info">Next of Kin's Contact Number</label>
                      <input type="text" id="next-of-kin-contact" name="next_of_kin_contact" class="form-control" placeholder="Contact Number" value="<?php echo isset($row['next_of_kin_contact']) ? htmlspecialchars($row['next_of_kin_contact']) : ''; ?>">
                  </td>
                </tr>
            </table>
          </div>

          <!-- Educational Information -->
          <div id="section3" class="input-group">
          <h4>Educational Information</h4>
          <table>
              <tr>
                <td>
                  <label for="educationLevel" class="info">Educational Attainment</label>
                  <input type="text" id="educationLevel" name="education_level" class="form-control" placeholder="Educational Attainment" value="<?php echo isset($row['education_level']) ? htmlspecialchars($row['education_level']) : ''; ?>">
              </td>
            </tr>
          </table>
          </div>

        <!-- Employment Details -->
        <div id="section4" class="input-group">
          <h4>Employment Details</h4>
          <table>
            <tr>
              <td>
                <label for="occupation" class="info">Occupation</label>
                <input type="text" id="occupation" name="occupation" class="form-control" value="<?php echo isset($row['occupation']) ? htmlspecialchars($row['occupation']) : ''; ?>">
              </td>
            </tr>
        </table>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<script src="../../javascript/script.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
