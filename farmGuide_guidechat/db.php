<?php
// db.php - Database connection with error logging
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'farmguide_chat';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    error_log("DB Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

// Set charset for proper encoding
$conn->set_charset("utf8");
?>