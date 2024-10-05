<?php
include 'conn_db.php';

// Query to get total users and accepted users
$sql = "SELECT 
            (SELECT COUNT(*) FROM applicant_profile) AS total_users,
            (SELECT COUNT(DISTINCT applicant_id) FROM applications WHERE status = 'accepted') AS accepted_users,
            (SELECT COUNT(DISTINCT applicant_id) FROM applications WHERE status = 'rejected') AS rejected_users,
            (SELECT COUNT(DISTINCT applicant_id) FROM applications WHERE status = 'interview') AS interview_users,
            (SELECT COUNT(DISTINCT applicant_id) FROM applications WHERE status = 'pending') AS pending_users";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$total_users = $row['total_users'];
$accepted_users = $row['accepted_users'];
$pending_users = $row['pending_users'];
$reject_users = $row['rejected_users'];
$interview_users = $row['interview_users'];

$total_applicant = $accepted_users + $pending_users + $reject_users + $interview_users; 
// Calculate percentages
$accepted_percentage = $accepted_users / $total_applicant * 100;
$pending_percentage = $pending_users / $total_applicant * 100;
$reject_percentage = $reject_users / $total_applicant * 100;
$interview_percentage = $interview_users  / $total_applicant * 100;
$other_percentage =  $total_users - $total_applicant;

// Query to get the accepted users details
$sql = "SELECT ap.*, a.* 
        FROM applicant_profile ap
        JOIN applications a ON ap.user_id = a.applicant_id
        WHERE a.status = 'accepted'
        GROUP BY ap.last_name, a.status";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Module List</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>applicant record List</h1>

    <!-- Pie Chart -->
    <canvas id="userPieChart" width="300" height="300"></canvas> <!-- Set to 100px by 100px -->
    <script>
        var ctx = document.getElementById('userPieChart').getContext('2d');
        var userPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Hired Applicant', 'Rejected Applicant', 'Pending Applicant', 'For Interview'],
                datasets: [{
                    label: 'Pecentage',
                    data: [<?php echo $accepted_percentage; ?>, <?php echo $reject_percentage; ?>, <?php echo $pending_percentage; ?>, <?php echo $interview_percentage; ?>],
                    backgroundColor: ['#4CAF50', '#FF6347', '#FFCE54', '#5D9CEC'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Disable responsive behavior for fixed size
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var percentage = tooltipItem.raw.toFixed(1) + '%'; // Round to 2 decimal places
                                return tooltipItem.label + ': ' + percentage;
                            }
                        }
                    },
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>
    <p><?php echo "total number of inactive user applicant '".$other_percentage."'";?></p>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Specialization</th>
            <th>Job Applied</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                echo "<tr>
                        <td>" . htmlspecialchars($full_name) . "</td>
                        <td>" . htmlspecialchars($row["dob"]) . "</td>
                        <td>" . htmlspecialchars($row["age"]) . "</td>
                        <td>" . htmlspecialchars($row["sex"]) . "</td>
                        <td>" . htmlspecialchars($row["specialization"]) . "</td>
                        <td>" . htmlspecialchars($row["job"]) . "</td>
                        <td>" . htmlspecialchars($row["status"]) . "</td>
                    </tr>";
            }
        } else {
            echo "
            <tr><td colspan='7'>No user found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <a href="rank_cases.php">ofw</a>
    <a href="job_hiring_rate.php">hiring rate</a>
    <a href="job_count.php">Job_count</a>
    <a href="employer_list.php">Back</a>
</body>
</html>
