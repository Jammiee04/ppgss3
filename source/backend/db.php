<?php
$hostname = 'localhost';
$username = 'root';
$password  = '';
$dbase = 'ppgss3';

$conn = mysqli_connect($hostname, $username, $password, $dbase);

if (!$conn) {
    die(mysqli_connect_error($conn));
}


// / Fetch only 2 announcements from the database
// $announcementQuery = "SELECT * FROM announcement ORDER BY id DESC LIMIT 2";
// $announcementResult = mysqli_query($conn, $announcementQuery);

// if ($announcementResult && mysqli_num_rows($announcementResult) > 0) {
//     while ($row = mysqli_fetch_assoc($announcementResult)) {
//         echo '<div>';
//         echo '<h3>' . $row['announcementTitle'] . '</h3>';
//         echo '<p>' . $row['announcementDescription'] . '</p>';
//         echo '</div>';
//     }
// } else {
//     echo '<p>No announcements available.</p>';
// }

// Close the connection
// $conn->close();
?>