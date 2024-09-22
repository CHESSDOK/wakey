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

// $user_id = checkSession();
// Get user_id from URL
// Fetch documents for the selected employer
$user_id = $_GET['user_id'];
$jobid = $_GET['job_id'];

$sql = "SELECT * FROM applicant_profile WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Employer Documents</title>
    <link rel="stylesheet" href="../../css/modal-form.css">
</head>
<body>
    <h1>Documents for Employer ID: <?php echo htmlspecialchars($user_id); ?></h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Contact number</th>
            <th>address</th>
            <th>specialization</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $fullname = $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'];
                echo "<tr>
                        <td>" . $fullname . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . htmlspecialchars($row["age"]) . "</td>
                        <td>" . htmlspecialchars($row["sex"]) . "</td>
                        <td>" . htmlspecialchars($row["contact_no"]) . "</td>
                        <td>" . htmlspecialchars($row["house_address"]) . "</td>
                        <td>" . htmlspecialchars($row["specialization"]) . "</td>
                        <td><a href='../../php/employer/application_process.php?id=" . $row['user_id'] . "'>accepted</a></td>
                        <td><button id='openFormBtn' 
                                    data-applicant-id=" . htmlspecialchars($row["user_id"]) ." 
                                    data-job-id=" . htmlspecialchars($jobid) .">interview</button></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No documents found</td></tr>";
        }
        $conn->close();
        ?>
    </table>


            <div id="formModal" class="modal">
                <div class="modal-content">
                <span class="closeBtn">&times;</span>
                <h2>Sign Up Form</h2>
                <form action="../../php/employer/interview.php" method="post">
                    <input type="hidden" id="applicantId" name="applicant_id" value="<?php echo $user_id?>">
                    <input type="hidden" id="jobid" name="jobid" value="<?php echo $jobid?>">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required><br><br>
                    <label for="time">time:</label>
                    <input type="time" id="time" name="time" required><br><br>
                    <label for="intervie">interview type:</label>
                        <select name="interview" id="interview">
                            <option value="online">online</option>
                            <option value="FacetoFace">Face to Face</option>>
                        </select>
                    <label for="onlinelink">Link:</label>
                    <input type="text" id="link" name="link"><br><br>

                    <label for="add">Pysical Address:</label>
                    <input type="text" id="link" name="link"><br><br>
                    <button type="submit">Submit</button>
                </form>
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
</body>
</html>
