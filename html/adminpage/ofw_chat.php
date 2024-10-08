<?php
    include 'conn_db.php';
    session_start();
    $admin_Id = $_SESSION['id'];
    $message_id = $_GET['message_id'];
    $user_id = $_GET['user_id'];
    $sql = "SELECT m.*, ap.first_name, ap.middle_name, ap.last_name, r.reply, ad.username AS admin_username
            FROM messages m 
            JOIN applicant_profile ap ON m.user_id = ap.user_id
            LEFT JOIN replies r ON m.id = r.message_id
            LEFT JOIN admin_profile ad ON r.admin_id = ad.id
            WHERE m.user_id = '$user_id'";  // Make sure to sanitize the input to avoid SQL injection

    $result = $conn->query($sql); 
echo "
<table class='table table-borderless table-hover'>
            <thead>
                <tr>
                    <th>Message</th>
                    <th>Reply</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
        $message = $row['message'];
        $reply = $row['reply'];
        $admin_username = $row['admin_username'];

        echo "<tr>
                <td>".$full_name." : ".$message."</td></tr>";

        if (!empty($reply)) {
            echo "<tr><td>".$admin_username." : ".$reply."</td>";
        } else {
            echo "<form action='send_message.php' method='post'>
                    <input type='hidden' name='message_id' value='".$row['id']."'>
                    <input type='hidden' name='admin_id' value='".$admin_Id."'>
                    <td><textarea id='message' name='reply'></textarea> </td> 
                    <td><button type='submit'>Send Message</button></td>
                    </form>
                    </tr>";
        }

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='2'>No messages found</td></tr>";
}
echo "</tbody>
        </table>";
$conn->close();
    
?>