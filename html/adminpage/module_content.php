<?php
include 'conn_db.php';
session_start();
$admin = $_SESSION['username'];
// Fetch all employers
$module_id = $_GET['module_id'];
$sql = "SELECT * FROM module_content WHERE modules_id = $module_id ";
$result = $conn->query($sql);
echo " <h2>Module Contents</h2>
    <table class='table table-borderless tbl_module'>";
if($result-> num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td class='upload-label'>Descrtption: " . $row["description"] . "</td>
              </tr>
              <tr>
                <td class='upload-label'>Video: " . $row["video"] . "</td>
              </tr>
              <tr>
                <td class='upload-label'>File : " . $row["file_path"] . "</td>
              </tr>
            </table>";
    }
}else {
    echo "<tr><td colspan='4'>No employers found</td></tr>";
}
$conn->close();
