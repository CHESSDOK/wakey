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

//Fetch data from applicant_profile table
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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/a_profile.css">
  <link rel="stylesheet" href="../../css/nav_float.css">

</head>

<body data-bs-spy="scroll" data-bs-target="#scrollspy-menu" data-bs-offset="175">

<!-- Navigation -->
<nav class="ofw-nav">
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#">PESO-lb.ph</a>
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
            <li><a href="training_list.php">training</a></li>
            <li><a href="ofw_home.php">OFW</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    <div class="auth">
        <button class="ofw-btn" id="emprof"><?php echo htmlspecialchars($row_new['username']); ?></button>
    </div>
</nav>

<header>
    <h1 class="ofw-h1">Profile</h1>
</header>


<div class="outer-container">
    <div class="container-fluid">
        <!-- Scrollspy Menu -->
        <nav id="scrollspy-menu" class="scrollspy flex-column">
            <a class="nav-link" href="#section1">Personal Information</a>
            <a class="nav-link" href="#section2">Job Preference</a>
            <a class="nav-link" href="#section3">Language/Dialect Proficiency</a>
            <a class="nav-link" href="#section4">Educational Background</a>
            <a class="nav-link" href="#section5">Technical/Vocational and Other Training</a>
            <a class="nav-link" href="#section6">Eligibility-Professional License</a>
            <a class="nav-link" href="#section6">Other Skills Acquired</a>
        </nav>
         <!-- Form Content -->
    <div class="form-content">
    <form action="../../php/#/#" method="POST">
        <!-- Personal Information -->
<div id="section1" class="input-group">
  <h4>Personal Information</h4>
  <table>
    <tr>
      <td>
        <label for="lastName" class="info">Surname</label>
        <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo isset($row['last_name']) ? htmlspecialchars($row['last_name']) : ''; ?>" required>
      </td>
      <td>
        <label for="firstName" class="info">First Name</label>
        <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo isset($row['first_name']) ? htmlspecialchars($row['first_name']) : ''; ?>" placeholder=" " required>
      </td>
      <td>
        <label for="middleName" class="info">Middle Name</label>
        <input type="text" id="middleName" name="middleName" class="form-control" value="<?php echo isset($row['middle_name']) ? htmlspecialchars($row['middle_name']) : ''; ?>">
      </td>
      <td>
        <label for="Prefix" class="info">Suffix</label>
        <select class="form-select" id="Prefix" name="Prefix">
          <option value="">Optional</option>
          <?php
            $prefixes = ['none', 'Sr.', 'Jr.', 'II', 'III', 'IV', 'V', 'VI', 'VII'];
            foreach ($prefixes as $prefix) {
              echo "<option value='$prefix'" . (isset($row['prefix']) && $row['prefix'] == $prefix ? ' selected' : '') . ">$prefix</option>";
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label for="dob" class="info">Date of Birth</label>
        <input type="date" id="dob" name="dob" class="form-control" value="<?php echo isset($row['dob']) ? htmlspecialchars($row['dob']) : ''; ?>" required>
      </td>
      <td colspan="2">
        <label for="pob" class="info">Place of Birth</label>
        <input type="text" id="#" name="#" class="form-control" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="religion" class="info">Religion</label>
        <input type="text" id="#" name="#" class="form-control" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
      </td>
      <td colspan="2">
        <label for="civilStatus" class="info">Civil Status</label>
        <select class="form-select" id="civilStatus" name="civilStatus" required>
          <option value="Single" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
          <option value="Married" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
          <option value="Widowed" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
          <option value="Separated" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Separated') ? 'selected' : ''; ?>>Separated</option>
          <option value="Live-in" <?php echo (isset($row['civil_status']) && $row['civil_status'] == 'Live-in') ? 'selected' : ''; ?>>Live-in</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="1">
        <label for="sex" class="info">Sex</label>
        <select class="form-select" id="sex" name="sex" required>
          <option value="Male" <?php echo (isset($row['sex']) && $row['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
          <option value="Female" <?php echo (isset($row['sex']) && $row['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        </select>
      </td>
      <td class="house" colspan="2">
        <label for="houseadd" class="info">Present Address</label>
        <input type="text" id="houseadd" name="houseadd" class="form-control h1ouse-info" placeholder="House no. / Street / Subdivision / Barangay / City or Municipality / Province" value="<?php echo isset($row['house_address']) ? htmlspecialchars($row['house_address']) : ''; ?>" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="tin" class="info">TIN</label>
        <input type="text" id="#" name="#" class="form-control" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
      </td>
      <td>
        <label for="height" class="info">Height</label>
        <input type="text" id="#" name="#" class="form-control" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="sssNo" class="info">GSIS/SSS No.</label>
        <input type="text" id="sssNo" name="sssNo" class="form-control" value="<?php echo isset($row['sss_no']) ? htmlspecialchars($row['sss_no']) : ''; ?>">
      </td>
      <td>
        <label for="pagibigNo" class="info">Pag-IBIG No.</label>
        <input type="text" id="pagibigNo" name="pagibigNo" class="form-control" value="<?php echo isset($row['pagibig_no']) ? htmlspecialchars($row['pagibig_no']) : ''; ?>">
      </td>
      <td>
        <label for="philhealthNo" class="info">PhilHealth No.</label>
        <input type="text" id="philhealthNo" name="philhealthNo" class="form-control" value="<?php echo isset($row['philhealth_no']) ? htmlspecialchars($row['philhealth_no']) : ''; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="email" class="info">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>" required>
      </td>
      <td>
        <label for="contactNo" class="info">Contact No.</label>
        <input type="tel" id="contactNo" name="contactNo" class="form-control" value="<?php echo isset($row['contact_no']) ? htmlspecialchars($row['contact_no']) : ''; ?>" required>
      </td>
      <td>
        <label for="landline" class="info">Landline No.</label>
        <input type="tel" id="Landline" name="Landline" class="form-control" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="pwd" class="info">Disability</label>
        <select class="form-select" id="pwd" name="pwd" required>
          <option value="Visual" <?php echo (isset($row['#']) && $row['#'] == 'Visual') ? 'selected' : ''; ?>>Visual</option>
          <option value="Hearing" <?php echo (isset($row['#']) && $row['#'] == 'Hearing') ? 'selected' : ''; ?>>Hearing</option>
          <option value="Speech" <?php echo (isset($row['#']) && $row['#'] == 'Speech') ? 'selected' : ''; ?>>Speech</option>
          <option value="Physical" <?php echo (isset($row['#']) && $row['#'] == 'Physical') ? 'selected' : ''; ?>>Physical</option>
          <option value="Others" <?php echo (isset($row['#']) && $row['#'] == 'Others') ? 'selected' : ''; ?>>Others</option>
        </select>
      </td>
      <td>
        <div id="disability-input" class="additional-input">
          <label for="disability-other" class="info">Please specify:</label>
          <input type="text" id="disability-other" class="form-control" placeholder="Enter details here">
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <label for="employment-status" class="info">Employment Status:</label>
        <select class="form-select" id="employment-status" required>
          <option value="">Select</option>
          <option value="employed">Employed</option>
          <option value="unemployed">Unemployed</option>
        </select>
      </td>
      <td>
        <div id="sub-dropdown" class="sub-dropdown">
          <label for="employment-type" class="info">Employment Type:</label>
          <select class="form-select" id="employment-type" required>
            <option value="">Select</option>
            <option value="wage">Wage Employed</option>
            <option value="self">Self Employed</option>
            <option value="fresh_grad" class="unemployed-option">New Entrant/Fresh Graduate</option>
            <option value="f_contract" class="unemployed-option">Finished Contract</option>
            <option value="resigned" class="unemployed-option">Resigned</option>
            <option value="retired" class="unemployed-option">Retired</option>
            <option value="local" class="unemployed-option">Terminated/Laidoff(local)</option>
            <option value="abroad" class="unemployed-option">Terminated/Laidoff(abroad)</option>
            <option value="others" class="unemployed-option">Others, specify</option>
          </select>
        </div>
      </td>
      <td>
        <div id="additional-input" class="info">
          <label for="other-reason">Please specify country, others:</label>
          <input type="text" id="other-reason" class="form-control" placeholder="Enter details here">
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <label for="actively-looking" class="info">Are you actively looking for work?</label>
        <select class="form-select" id="actively-looking" name="actively-looking" required>
          <option value="">Select</option>
          <option value="Yes" <?php echo (isset($row['actively-looking']) && $row['actively-looking'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
          <option value="No" <?php echo (isset($row['actively-looking']) && $row['actively-looking'] == 'No') ? 'selected' : ''; ?>>No</option>
        </select>
      </td>
      <td colspan="2">
        <div id="actively-looking-input" class="additional-input">
          <label for="actively-looking-details" class="info">Please specify:</label>
          <input type="text" id="actively-looking-details" class="form-control" placeholder="How long have you been looking for work?">
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <label for="willing-to-work" class="info">Willing to work immediately?</label>
        <select class="form-select" id="willing-to-work" name="willing-to-work" required>
          <option value="">Select</option>
          <option value="Yes" <?php echo (isset($row['willing-to-work']) && $row['willing-to-work'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
          <option value="No" <?php echo (isset($row['willing-to-work']) && $row['willing-to-work'] == 'No') ? 'selected' : ''; ?>>No</option>
        </select>
      </td>
      <td colspan="2">
        <div id="willing-to-work-input" class="additional-input">
          <label for="willing-to-work-details" class="info">Please specify:</label>
          <input type="text" id="willing-to-work-details" class="form-control" placeholder="If no, when?">
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <label for="four-ps-beneficiary" class="info">Are you a 4Ps beneficiary?</label>
        <select class="form-select" id="four-ps-beneficiary" name="four-ps-beneficiary" required>
          <option value="">Select</option>
          <option value="Yes" <?php echo (isset($row['four-ps-beneficiary']) && $row['four-ps-beneficiary'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
          <option value="No" <?php echo (isset($row['four-ps-beneficiary']) && $row['four-ps-beneficiary'] == 'No') ? 'selected' : ''; ?>>No</option>
        </select>
      </td>
      <td colspan="2">
        <div id="household-id-input" class="additional-input">
          <label for="household-id" class="info">If yes, Household ID No.</label>
          <input type="text" id="household-id" class="form-control" placeholder="Household ID">
        </div>
      </td>
    </tr>
  </table>
</div>

    <!--Job Preference Section 2-->
<div id="section2" class="input-group">
  <h4>Job Preference</h4>
  <table>
    <tr>
      <td>
        <label for="occupation" class="info">Preferred Occupation</label>
        <input type="text" id="occupation_1" name="#" class="form-control ocu_input" placeholder="1 - Occupation" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
        <input type="text" id="occupation_2" name="#" class="form-control ocu_input" placeholder="2 - Occupation" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
        <input type="text" id="occupation_3" name="#" class="form-control ocu_input" placeholder="3 - Occupation" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
        <input type="text" id="occupation_4" name="#" class="form-control ocu_input" placeholder="4 - Occupation" value="<?php echo isset($row['#']) ? htmlspecialchars($row['#']) : ''; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="pwl" class="info">Preferred Work Location</label>
        <select class="form-select" id="pwl" name="pwl" required>
          <option value="">Select</option>
          <option value="local" <?php echo (isset($row['pwl']) && $row['pwl'] == 'local') ? 'selected' : ''; ?>>Local, specify cities/municipalities</option>
          <option value="overseas" <?php echo (isset($row['pwl']) && $row['pwl'] == 'overseas') ? 'selected' : ''; ?>>Overseas, specify countries</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <div id="local-input" class="location-input">
          <input type="text" name="local" class="form-control pwl_input" placeholder="1 - City/Municipality" value="<?php echo isset($row['local-city1']) ? htmlspecialchars($row['local-city1']) : ''; ?>">
          <input type="text" name="local" class="form-control pwl_input" placeholder="2 - City/Municipality" value="<?php echo isset($row['local-city2']) ? htmlspecialchars($row['local-city2']) : ''; ?>">
          <input type="text" name="local" class="form-control pwl_input" placeholder="3 - City/Municipality" value="<?php echo isset($row['local-city3']) ? htmlspecialchars($row['local-city3']) : ''; ?>">
        </div>
            
        <div id="overseas-input" class="location-input">
          <input type="text" name="overseas-country1" class="form-control overseas-option pwl_input" placeholder="1 - Country" value="<?php echo isset($row['overseas-country1']) ? htmlspecialchars($row['overseas-country1']) : ''; ?>">
          <input type="text" name="overseas-country2" class="form-control overseas-option pwl_input" placeholder="2 - Country" value="<?php echo isset($row['overseas-country2']) ? htmlspecialchars($row['overseas-country2']) : ''; ?>">
          <input type="text" name="overseas-country3" class="form-control overseas-option pwl_input" placeholder="3 - Country" value="<?php echo isset($row['overseas-country3']) ? htmlspecialchars($row['overseas-country3']) : ''; ?>">
        </div>
      </td>
    </tr>
    <tr>
      <td>
          <label for="salary" class="info">Expected Salary</label>
          <input type="text" id="salary" class="form-control" placeholder="Input Range" require>
      </td>
      <td>
          <label for="passport" class="info">Passport No.</label>
          <input type="text" id="passport" class="form-control" placeholder="Input Passport Number" require>
      </td>
      <td>
          <label for="passport_expiry" class="info">Expiry date</label>
          <input type="date" id="passport_expiry" class="form-control" placeholder="Input Range" require>
      </td>
    </tr>
  </table>
</div>

<!--Language Proficiency-->
<div id="section3" class="input-group">
  <h4>Language/Dialect Proficiency</h4>
  <table>
    <tr>
      <td>
        <label class="info">(check if applicable)</label>
      </td>
      <td>
        <label class="info lguages">Read</label>
      </td>
      <td>
        <label class="info lguages">Write</label>
      </td>
      <td>
        <label class="info lguages">Speak</label>
      </td>
      <td>
        <label class="info lguages">Understand</label>
      </td>
    </tr>
    
    <tr>
       <td>
         <label class="info">English</label>
      </td>
      <td>
        <input class="form-check-input lguages" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
    </tr> 

    <tr>
       <td>
        <label class="info">Filipino</label>
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
    </tr> 

    <tr>
       <td>
        <label class="info">Others</label>
        <input type="text" id="language_others" class="form-control">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
      </td>
    </tr> 
  </table>
</div>

<div id="section4" class="input-group">
  <h4>Educational Background</h4>
  <table>
  </table>
</div>

<div id="section5" class="input-group">
  <h4>Technical/Vocational and Other Training</h4>
  <table>
  </table>
</div>

<div id="section6" class="input-group">
  <h4>Eligibility-Professional License</h4>
  <table>
  </table>
</div>

<div id="section7" class="input-group">
  <h4>Other Skills Acquired</h4>
  <table>
  </table>
</div>

<div id="section2" class="input-group">
  <h4>Personal Information</h4>
  <table>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="../../javascript/a_profile.js"></script> 
<script src="../../javascript/script.js"></script> 
</body>
</html>