<?php
include 'conn_db.php';

// Fetch the list of applicants taking the course along with module progress
$sql = "SELECT ap.id, ap.first_name, ap.middle_name, ap.last_name, ap.email, 
               m.module_name, c.course_name, mt.status
        FROM modules_taken mt
        JOIN applicant_profile ap ON ap.user_id = mt.user_id
        JOIN modules m ON m.id = mt.module_id
        JOIN courses c ON c.id = m.course_id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Create an associative array to group data by applicant
$applicants = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $middle_initial = !empty($row['middle_name']) ? strtoupper($row['middle_name'][0]) . '. ' : '';
        $fullname = htmlspecialchars($row['first_name'] . ' ' . $middle_initial . $row['last_name']);
        $course_name = htmlspecialchars($row["course_name"]);
        $module_name = htmlspecialchars($row["module_name"]);

        // Correctly display the module name to handle special characters
        $module_name = str_replace('&amp;', '&', $module_name);
        
        // Determine the status of the module for display
        if ($row['status'] === 'passed') {
            $status_display = "<span class='text-success'>&#10004; Passed</span>"; // Green check
        } elseif ($row['status'] === 'fail') {
            $status_display = "<span class='text-danger'>&#10008; Failed</span>"; // Red cross
        } else {
            $status_display = "<span class='text-warning'>Not Attempted</span>"; // Yellow or default
        }

        // Grouping data by applicant and course
        $applicants[$fullname]['course'] = $course_name;
        $applicants[$fullname]['modules'][] = ["name" => $module_name, "status" => $status_display];
    }
} 

echo "<table class='table table-borderless table-hover'> <!-- Add Bootstrap table class -->
<thead>
    <tr>
        <th>Full Name</th>
        <th>Course Taken</th>
        <th>Module Progress</th>
    </tr>
</thead>
<tbody>";

foreach ($applicants as $fullname => $data) {
    // Display the applicant's name and course
    echo "<tr>
            <td>{$fullname}</td>
            <td>{$data['course']}</td>
            <td>";

    // Loop through each module and display its status
    foreach ($data['modules'] as $module) {
        echo htmlspecialchars($module['name']) . " (" . $module['status'] . ")<br>";
    }

    echo "</td></tr>";
}

if (empty($applicants)) {
    echo "<tr><td colspan='3'>No modules found</td></tr>";
}

echo "</tbody></table>";
$stmt->close(); // Close the prepared statement
$conn->close(); // Close the database connection
?>
