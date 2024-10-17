<?php
// api.php

// Get the current timestamp in UTC
$currentTimestamp = time();

// Add 8 hours to the timestamp to convert it to UTC+8
$currentTimestamp += 8 * 60 * 60;

// Format the timestamp as a readable date and time in UTC+8
$currentDateTime = gmdate('Y-m-d H:i:s', $currentTimestamp);

// Output the current date and time in UTC+8 as JSON
header('Content-Type: application/json');
echo json_encode(['dateTime' => $currentDateTime]);
?>